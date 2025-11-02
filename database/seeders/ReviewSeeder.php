<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample review titles and comments
        $positiveReviews = [
            [
                'title' => 'Excellent work and great communication!',
                'comment' => 'The freelancer delivered exactly what I needed. Very professional and responsive throughout the project. Highly recommended!',
            ],
            [
                'title' => 'Outstanding quality and fast delivery',
                'comment' => 'Exceeded my expectations! The work was completed ahead of schedule with exceptional attention to detail.',
            ],
            [
                'title' => 'Highly skilled professional',
                'comment' => 'Amazing experience working with this freelancer. Will definitely hire again for future projects.',
            ],
            [
                'title' => 'Perfect!',
                'comment' => 'Everything was perfect from start to finish. Great communication and excellent final product.',
            ],
        ];

        $neutralReviews = [
            [
                'title' => 'Good work, minor revisions needed',
                'comment' => 'The work was good overall but required a few revisions to meet our exact requirements.',
            ],
            [
                'title' => 'Satisfactory result',
                'comment' => 'The project was completed as described. Communication could have been better but the end result was acceptable.',
            ],
        ];

        $negativeReviews = [
            [
                'title' => 'Missed deadline',
                'comment' => 'The quality of work was okay but the project was delivered late which caused some issues on our end.',
            ],
            [
                'title' => 'Below expectations',
                'comment' => 'The work did not meet our expectations and required significant revisions.',
            ],
        ];

        // Get all completed orders
        $completedOrders = Order::where('status', 'completed')
            ->whereDoesntHave('review') // Only orders without reviews
            ->with(['user', 'freelancer'])
            ->get();

        if ($completedOrders->isEmpty()) {
            $this->command->warn('No completed orders found to seed reviews!');
            return;
        }

        foreach ($completedOrders as $order) {
            // Randomly decide rating distribution (80% positive, 15% neutral, 5% negative)
            $rand = rand(1, 100);
            
            if ($rand <= 80) {
                // Positive review (4-5 stars)
                $rating = rand(4, 5);
                $reviewData = $positiveReviews[array_rand($positiveReviews)];
                $qualityRating = rand(4, 5);
                $communicationRating = rand(4, 5);
                $deadlineRating = rand(4, 5);
                $professionalismRating = rand(4, 5);
            } elseif ($rand <= 95) {
                // Neutral review (3 stars)
                $rating = 3;
                $reviewData = $neutralReviews[array_rand($neutralReviews)];
                $qualityRating = rand(2, 4);
                $communicationRating = rand(2, 4);
                $deadlineRating = rand(2, 4);
                $professionalismRating = rand(2, 4);
            } else {
                // Negative review (1-2 stars)
                $rating = rand(1, 2);
                $reviewData = $negativeReviews[array_rand($negativeReviews)];
                $qualityRating = rand(1, 3);
                $communicationRating = rand(1, 3);
                $deadlineRating = rand(1, 3);
                $professionalismRating = rand(1, 3);
            }

            Review::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'freelancer_id' => $order->freelancer_id,
                'rating' => $rating,
                'title' => $reviewData['title'],
                'comment' => $reviewData['comment'],
                'quality_rating' => $qualityRating,
                'communication_rating' => $communicationRating,
                'deadline_rating' => $deadlineRating,
                'professionalism_rating' => $professionalismRating,
                'helpful_count' => rand(0, 15),
                'is_verified' => rand(0, 1) ? true : false,
                'is_published' => true,
            ]);
        }

        $this->command->info('Reviews seeded successfully!');
    }
}