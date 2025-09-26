<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'author_name' => 'B.N.',
                'content' => 'Amy is great! She is very knowledgeable and thorough. I know when I go for a visit that I am getting the best care possible. She is also great at giving shots. As pain free as possible. Thank you.',
                'rating' => 5,
                'source' => 'Google',
                'featured' => true,
                'active' => true,
            ],
            [
                'author_name' => 'Sarah M.',
                'content' => 'Excellent service and professional staff. Amy is incredibly knowledgeable and makes you feel comfortable throughout the entire process. Highly recommend!',
                'rating' => 5,
                'source' => 'Google',
                'featured' => true,
                'active' => true,
            ],
            [
                'author_name' => 'Jennifer L.',
                'content' => 'The IV therapy treatments have been life-changing. I feel more energized and my overall health has improved significantly. The staff is amazing!',
                'rating' => 5,
                'source' => 'Yelp',
                'featured' => true,
                'active' => true,
            ],
            [
                'author_name' => 'Michael R.',
                'content' => 'Professional, clean, and effective treatments. Amy takes the time to explain everything and ensures you\'re comfortable. Great results!',
                'rating' => 5,
                'source' => 'Google',
                'featured' => true,
                'active' => true,
            ],
            [
                'author_name' => 'Lisa K.',
                'content' => 'The skin treatments are amazing. I can see a real difference in my complexion. The facility is beautiful and the staff is very professional.',
                'rating' => 5,
                'source' => 'Facebook',
                'featured' => true,
                'active' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::updateOrCreate([
                'author_name' => $review['author_name'],
                'content' => $review['content'],
            ], $review);
        }
    }
}
