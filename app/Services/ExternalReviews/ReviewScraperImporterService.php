<?php

namespace App\Services\ExternalReviews;

use Illuminate\Support\Facades\Log;

class ReviewScraperImporterService
{
    private GoogleReviewsScraperService $googleScraper;

    private YelpReviewsScraperService $yelpScraper;

    public function __construct(
        WebScraperService $webScraper
    ) {
        $this->googleScraper = new GoogleReviewsScraperService($webScraper);
        $this->yelpScraper = new YelpReviewsScraperService($webScraper);
    }

    /**
     * Import reviews from all configured sources using scrapers
     */
    public function importAllReviews(): array
    {
        $results = [
            'google' => 0,
            'yelp' => 0,
            'total' => 0,
            'errors' => [],
        ];

        // Import Google reviews
        try {
            $results['google'] = $this->googleScraper->importReviews();
        } catch (\Exception $e) {
            $results['errors'][] = 'Google Reviews: '.$e->getMessage();
            Log::error('Google Reviews scraping import failed: '.$e->getMessage());
        }

        // Briefly delay between scrapes to avoid being throttled
        $this->addDelay(2);

        // Import Yelp reviews
        try {
            $results['yelp'] = $this->yelpScraper->importReviews();
        } catch (\Exception $e) {
            $results['errors'][] = 'Yelp Reviews: '.$e->getMessage();
            Log::error('Yelp Reviews scraping import failed: '.$e->getMessage());
        }

        $results['total'] = $results['google'] + $results['yelp'];
        Log::info('Scraper import completed', $results);

        return $results;
    }

    /**
     * Run Google review scraping only
     */
    public function importGoogleReviews(): int
    {
        return $this->googleScraper->importReviews();
    }

    /**
     * Run Yelp review scraping only
     */
    public function importYelpReviews(): int
    {
        return $this->yelpScraper->importReviews();
    }

    /**
     * Safely delay for crawler throttling
     */
    protected function addDelay(int $seconds = 1): void
    {
        sleep($seconds);
    }
}
