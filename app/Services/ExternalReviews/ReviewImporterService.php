<?php

namespace App\Services\ExternalReviews;

use Illuminate\Support\Facades\Log;

class ReviewImporterService
{
    private GoogleReviewsService $googleReviewsService;

    private YelpReviewsService $yelpReviewsService;

    public function __construct(
        GoogleReviewsService $googleReviewsService,
        YelpReviewsService $yelpReviewsService
    ) {
        $this->googleReviewsService = $googleReviewsService;
        $this->yelpReviewsService = $yelpReviewsService;
    }

    /**
     * Import reviews from all configured sources
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
            $results['google'] = $this->googleReviewsService->importReviews();
        } catch (\Exception $e) {
            $results['errors'][] = 'Google Reviews: '.$e->getMessage();
            Log::error('Google Reviews import failed: '.$e->getMessage());
        }

        // Import Yelp reviews
        try {
            $results['yelp'] = $this->yelpReviewsService->importReviews();
        } catch (\Exception $e) {
            $results['errors'][] = 'Yelp Reviews: '.$e->getMessage();
            Log::error('Yelp Reviews import failed: '.$e->getMessage());
        }

        $results['total'] = $results['google'] + $results['yelp'];

        Log::info('Review import completed', $results);

        return $results;
    }

    /**
     * Import reviews from Google only
     */
    public function importGoogleReviews(): int
    {
        return $this->googleReviewsService->importReviews();
    }

    /**
     * Import reviews from Yelp only
     */
    public function importYelpReviews(): int
    {
        return $this->yelpReviewsService->importReviews();
    }
}
