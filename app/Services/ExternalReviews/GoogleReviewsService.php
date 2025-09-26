<?php

namespace App\Services\ExternalReviews;

use App\Models\Review;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleReviewsService
{
    private ?string $apiKey;

    private ?string $placeId;

    public function __construct()
    {
        $this->apiKey = config('services.google.places.api_key');
        $this->placeId = config('services.google.places.place_id');
    }

    /**
     * Fetch reviews from Google Places API
     */
    public function fetchReviews(): array
    {
        try {
            if (! $this->apiKey || ! $this->placeId) {
                Log::warning('Google Places API credentials not configured');

                return [];
            }

            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $this->placeId,
                'fields' => 'reviews,rating,user_ratings_total',
                'key' => $this->apiKey,
            ]);

            if (! $response->successful()) {
                Log::error('Google Places API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            $data = $response->json();

            if (! isset($data['result']['reviews'])) {
                Log::warning('No reviews found in Google Places API response');

                return [];
            }

            return $this->parseGoogleReviews($data['result']['reviews']);

        } catch (\Exception $e) {
            Log::error('Google Reviews fetch failed: '.$e->getMessage());

            return [];
        }
    }

    /**
     * Parse Google reviews data into standardized format
     */
    private function parseGoogleReviews(array $googleReviews): array
    {
        return array_map(function ($googleReview) {
            return [
                'external_id' => 'google_'.$googleReview['time'].'_'.crc32($googleReview['text'] ?? ''),
                'author_name' => $googleReview['author_name'] ?? 'Anonymous Google User',
                'author_avatar_url' => $googleReview['profile_photo_url'] ?? null,
                'content' => $googleReview['text'] ?? '',
                'rating' => $googleReview['rating'] ?? 5,
                'review_date' => isset($googleReview['time'])
                    ? \Carbon\Carbon::createFromTimestamp($googleReview['time'])
                    : now(),
                'external_review_url' => $googleReview['author_url'] ?? null,
                'additional_data' => [
                    'google_review_data' => [
                        'relative_time_description' => $googleReview['relative_time_description'] ?? null,
                        'author_url' => $googleReview['author_url'] ?? null,
                        'profile_photo_url' => $googleReview['profile_photo_url'] ?? null,
                        'photo_urls' => $googleReview['photos'] ?? [],
                    ],
                ],
            ];
        }, $googleReviews);
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
                Review::createOrUpdateFromExternal($reviewData, 'google');
                $importedCount++;
            } catch (\Exception $e) {
                Log::error('Failed to import Google review: '.$e->getMessage(), [
                    'review_data' => $reviewData,
                ]);
            }
        }

        Log::info("Imported {$importedCount} Google reviews");

        return $importedCount;
    }
}
