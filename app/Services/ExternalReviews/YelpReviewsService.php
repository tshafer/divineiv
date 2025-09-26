<?php

namespace App\Services\ExternalReviews;

use App\Models\Review;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YelpReviewsService
{
    private ?string $apiKey;

    private ?string $businessId;

    public function __construct()
    {
        $this->apiKey = config('services.yelp.api_key');
        $this->businessId = config('services.yelp.business_id');
    }

    /**
     * Fetch reviews from Yelp Fusion API
     */
    public function fetchReviews(): array
    {
        try {
            if (! $this->apiKey || ! $this->businessId) {
                Log::warning('Yelp API credentials not configured');

                return [];
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
            ])->get("https://api.yelp.com/v3/businesses/{$this->businessId}/reviews");

            if (! $response->successful()) {
                Log::error('Yelp API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            $data = $response->json();

            if (! isset($data['reviews'])) {
                Log::warning('No reviews found in Yelp API response');

                return [];
            }

            return $this->parseYelpReviews($data['reviews']);

        } catch (\Exception $e) {
            Log::error('Yelp Reviews fetch failed: '.$e->getMessage());

            return [];
        }
    }

    /**
     * Parse Yelp reviews data into standardized format
     */
    private function parseYelpReviews(array $yelpReviews): array
    {
        return array_map(function ($yelpReview) {
            return [
                'external_id' => 'yelp_'.$yelpReview['id'],
                'author_name' => $yelpReview['user']['name'] ?? 'Anonymous Yelp User',
                'author_avatar_url' => $yelpReview['user']['image_url'] ?? null,
                'content' => $yelpReview['text'] ?? '',
                'rating' => $yelpReview['rating'] ?? 5,
                'review_date' => isset($yelpReview['time_created'])
                    ? \Carbon\Carbon::parse($yelpReview['time_created'])
                    : now(),
                'external_review_url' => $yelpReview['url'] ?? null,
                'additional_data' => [
                    'yelp_review_data' => [
                        'business_id' => $this->businessId,
                        'user_id' => $yelpReview['user']['id'] ?? null,
                        'user_profile_url' => $yelpReview['user']['profile_url'] ?? null,
                        'review_url' => $yelpReview['url'] ?? null,
                        'language' => $yelpReview['language'] ?? 'en',
                    ],
                ],
            ];
        }, $yelpReviews);
    }

    /**
     * Import reviews into database
     */
    public function importReviews(): int
    {
        $reviews = $this->fetchReviews();
        $importedCount = 0;

        foreach ($reviews as $reviewData) {
            try {
                Review::createOrUpdateFromExternal($reviewData, 'yelp');
                $importedCount++;
            } catch (\Exception $e) {
                Log::error('Failed to import Yelp review: '.$e->getMessage(), [
                    'review_data' => $reviewData,
                ]);
            }
        }

        Log::info("Imported {$importedCount} Yelp reviews");

        return $importedCount;
    }
}
