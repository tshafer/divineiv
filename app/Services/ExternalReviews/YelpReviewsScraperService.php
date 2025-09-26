<?php

namespace App\Services\ExternalReviews;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class YelpReviewsScraperService
{
    private WebScraperService $scraper;

    public ?string $businessUrl;

    public function __construct(WebScraperService $scraper)
    {
        $this->scraper = $scraper;
        $this->businessUrl = config('services.yelp.business_url');
    }

    public function fetchReviews(): array
    {
        try {
            if (! $this->businessUrl) {
                Log::warning('Yelp Business URL not configured');

                return [];
            }

            // Fetch the main business page first
            $html = $this->scraper->scrape($this->businessUrl);
            if (! $html) {
                return [];
            }

            $crawler = $this->scraper->parseHtml($html);

            return $this->scrapeReviewData($crawler);

        } catch (\Exception $e) {
            Log::error('Yelp Reviews scraping failed: '.$e->getMessage());

            return [];
        }
    }

    protected function scrapeReviewData(Crawler $document): array
    {
        $reviews = [];

        // Get all possible review containers
        $reviewContainers = [
            '.review',
            '[data-review-id]',
            'li[data-review-id]',
            '.review__09f24__voieC',
            '.mainAttributes__09f24__mAV89',
            '.commonsShadowContainer__09f24__KYEKy',
        ];

        foreach ($reviewContainers as $selector) {
            try {
                $reviewElements = $document->filter($selector);

                if ($reviewElements->count() > 0) {
                    foreach ($reviewElements as $element) {
                        $elementCrawler = new Crawler($element, null, '');

                        $review = $this->parseSingleYelpReview($elementCrawler);
                        if (! empty(trim($review['content'] ?? ''))) {
                            $reviews[] = $review;
                        }
                    }
                    if (count($reviews) > 0) {
                        break;
                    } // Exit first successful selector
                }
            } catch (\Exception $e) {
                continue; // Skip invalid selectors
            }
        }

        // Clean out any empty reviews
        return array_filter($reviews, fn ($r) => ! empty($r['content']) && strlen($r['content']) > 10);
    }

    protected function parseSingleYelpReview(Crawler $element): array
    {
        $author = $this->extractAuthor($element);
        $rating = $this->extractRating($element);
        $content = $this->extractContent($element);
        $date = $this->extractDate($element);
        $avatar = $this->extractAvatar($element);

        $author = trim($author ?: 'Yelp User');
        $reviewDate = $date ? $this->screenDate($date) : now();

        return [
            'external_id' => 'yelp_html_'.crc32($content.$author),
            'author_name' => $author,
            'author_avatar_url' => $avatar,
            'content' => trim($content ?: ''),
            'rating' => $rating ?? 5.0,
            'review_date' => $reviewDate,
            'external_review_url' => null,
            'additional_data' => [
                'yelp_review_data' => [
                    'scraped_at' => now(),
                    'source_url' => $this->businessUrl,
                    'unique' => true,
                ],
            ],
        ];
    }

    protected function extractAuthor(Crawler $element): string
    {
        // Various Yelp author name selectors
        $selectors = [
            '.css-1e2a0fm',
            '[class*="author-name"]',
            '[data-ownerid] .css-1ix4myn, [data-ownerid] .css-1vwq1s',
            '[class*="username"] a',
            '.css-e81k0o h6 a',
            '.css-e81k0o a strong',
            '.userName__09f24__3ErNq',
            'h6 a',
        ];

        foreach ($selectors as $sel) {
            $text = $this->scraper->extractText($element, $sel);
            if ($text && strlen($text) > 3) {
                return trim($text);
            }
        }

        return 'Yelp User';
    }

    protected function extractRating(Crawler $element): ?float
    {
        // Try to find ratings in multiple ways
        $ratingText = $this->scraper->extractText($element, '.i-stars::attr(class)', 'i.rating-i::attr(class)');

        // Extract number from class like 'stars_3' or 'rating-i-3'
        if (preg_match('/stars_(\d)/', strval($ratingText), $m)) {
            return (float) $m[1];
        }

        if (preg_match('/rating-i-(\d)/i', strval($ratingText), $m)) {
            return (float) $m[1];
        }

        // Accumulate all CSS class values that might encode a rating
        $classes = implode(' ', iterator_to_array($element->filter('i, span, div')->extract(['class'])));
        if (preg_match('/\b([12345])\s*star\b/i', $classes, $m)) {
            return (float) floatval($m[1]);
        }

        return null;
    }

    protected function extractContent(Crawler $element): string
    {
        // Nested p tags and exludes profile links before content
        $contentSelectors = [
            '.review-content p',
            '.review-content div',
            '.review__section__09f24__BhLPE div p',
            '.css-1300exh',
            '[class*="review-content"]',
            '[aria-label="review"] > p',
            '[data-section-press-area="review-content"] p',
            '.css-126j0fz .css-3382on p',
            '.review-content[data-ownerid] p',
        ];

        $content = '';
        foreach ($contentSelectors as $sel) {
            $found = $this->scraper->extractText($element, $sel);
            if ($found && empty($content) && strlen($found) > 20) {
                $content = $found;
            }
        }

        if (empty($content)) {
            // Grab any significant text containing review text
            $reviewDivs = $element->filter('p, [data-ownerid] p');
            if ($reviewDivs->count() > 0) {
                $combined = '';
                $reviewDivs->each(function (Crawler $div, $idx) use (&$combined) {
                    $text = trim($div->text());
                    if (! empty($text) && ! preg_match('@^(read more|add photos|more)(\.\.\.)?\s*$@is', $text)) {
                        $combined .= "\n".$text;
                    }
                });
                $content = trim($combined);
            }
        }

        return trim(preg_replace('/\s+/', ' ', $content));
    }

    protected function extractDate(Crawler $element): ?string
    {
        $texts = $element->filter('[class*="date"], [aria-label*="date"], time[datetime]');

        return $texts->attr('datetime') ?: $texts->text() ?: null;
    }

    protected function extractAvatar(Crawler $element): ?string
    {
        $imgs = $element->filter('.css-iq66dd, img');
        $src = ($imgs->count() > 0 ? $imgs->attr('src') : null);

        return ($src && str_contains($src, 'yelpcdn')) ? html_entity_decode($src) : null;
    }

    protected function screenDate(mixed $dateInput): Carbon
    {
        try {
            // Must be a string to parse
            $date = is_string($dateInput) ? $dateInput : strtotime($dateInput) / 3600 * 3600;

            return Carbon::parse($date);
        } catch (\Exception $e) {
            return now();
        }
    }

    public function importReviews(): int
    {
        $reviews = $this->fetchReviews();
        $importedCount = 0;

        foreach ($reviews as $reviewData) {
            try {
                Review::createOrUpdateFromExternal($reviewData, 'yelp');
                $importedCount++;
            } catch (\Exception $e) {
                Log::error('Failed to import Yelp review: '.$e->getMessage(), ['review_data' => $reviewData]);
            }
        }

        Log::info("Imported {$importedCount} Yelp reviews");

        return $importedCount;
    }
}
