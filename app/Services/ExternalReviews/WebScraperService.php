<?php

namespace App\Services\ExternalReviews;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class WebScraperService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => '1',
            ],
        ]);
    }

    /**
     * Scrape a webpage and return the HTML content
     */
    public function scrape(string $url): ?string
    {
        try {
            $response = $this->client->get($url);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            Log::error('Failed to scrape URL: '.$url, [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            return null;
        }
    }

    /**
     * Parse HTML content using DomCrawler
     */
    public function parseHtml(string $html): Crawler
    {
        return new Crawler($html);
    }

    /**
     * Sleep and retry mechanism for rate limiting
     */
    public function delay(int $seconds = 2): void
    {
        sleep($seconds);
    }

    /**
     * Extract text from a crawler element
     */
    public function extractText(Crawler $crawler, string $selector): string
    {
        try {
            return $crawler->filter($selector)->text();
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Extract attribute from a crawler element
     */
    public function extractAttribute(Crawler $crawler, string $selector, string $attribute = 'href'): string
    {
        try {
            return $crawler->filter($selector)->attr($attribute) ?? '';
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Extract count/rating from star elements
     */
    public function extractRatingFromStars(Crawler $starElements): ?float
    {
        try {
            $stars = $starElements->filter('.star, .fa-star, [class*="star"]');
            $activeStars = $stars->filter('.full, .active, .selected');

            return $activeStars->count() > 0 ? (float) $activeStars->count() : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Normalize a URL to absolute
     */
    public function normalizeUrl(string $url, string $baseUrl = ''): string
    {
        if (str_starts_with($url, 'http')) {
            return $url;
        }

        $parsed = parse_url($baseUrl);
        $scheme = $parsed['scheme'] ?? 'https';
        $host = $parsed['host'] ?? '';

        if (str_starts_with($url, '/')) {
            return $scheme.'://'.$host.$url;
        }

        return $baseUrl.'/'.ltrim($url, '/');
    }
}
