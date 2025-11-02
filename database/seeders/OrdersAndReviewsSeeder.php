<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Database\Seeder;

class OrdersAndReviewsSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create users
        $clients = User::where('role', 'client')->get();
        $freelancers = User::where('role', 'freelancer')->get();

        // If no users exist, create some
        if ($clients->isEmpty() || $freelancers->isEmpty()) {
            $this->command->warn('Creating test users...');
            
            // Create clients
            for ($i = 1; $i <= 3; $i++) {
                User::create([
                    'name' => "Client User $i",
                    'email' => "client$i@example.com",
                    'password' => bcrypt('password'),
                    'role' => 'client',
                ]);
            }
            
            // Create freelancers
            for ($i = 1; $i <= 3; $i++) {
                User::create([
                    'name' => "Freelancer User $i",
                    'email' => "freelancer$i@example.com",
                    'password' => bcrypt('password'),
                    'role' => 'freelancer',
                ]);
            }
            
            $clients = User::where('role', 'client')->get();
            $freelancers = User::where('role', 'freelancer')->get();
        }

        $this->command->info('Creating completed orders...');

        // Sample job titles
        $jobTitles = [
            'Website Design and Development',
            'Logo Design for Startup',
            'Mobile App Development',
            'Content Writing - Blog Posts',
            'Social Media Marketing Campaign',
            'SEO Optimization Services',
            'Video Editing Project',
            'Graphic Design - Brochure',
            'E-commerce Store Setup',
            'WordPress Custom Theme',
        ];

        // Create 20 completed orders
        foreach ($clients as $client) {
            foreach ($freelancers as $freelancer) {
                for ($i = 0; $i < 3; $i++) {
                    Order::create([
                        'user_id' => $client->id,
                        'freelancer_id' => $freelancer->id,
                        'job_title' => $jobTitles[array_rand($jobTitles)],
                        // 'job_description' => 'This is a test job description for the order. The client needs professional work completed with high quality standards.',
                        'price' => rand(500000, 5000000),
                        'status' => 'completed',
                        'created_at' => now()->subDays(rand(1, 60)),
                        'updated_at' => now()->subDays(rand(1, 30)),
                    ]);
                }
            }
        }

        $this->command->info('Orders created successfully!');
        $this->command->info('Now seeding reviews...');

        // Now seed the reviews
        $this->call(ReviewSeeder::class);
    }
}