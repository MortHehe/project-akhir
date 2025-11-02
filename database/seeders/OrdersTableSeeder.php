<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example orders
        DB::table('orders')->insert([
            [
                'user_id' => 1, // Assuming 1 is the client ID
                'freelancer_id' => 2, // Freelancer 1 ID
                'job_title' => 'Mobile App UI/UX Design',
                'price' => 3500000,
                'freelancer_email' => 'freelancer1@test.com',
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1, // Assuming 1 is the client ID
                'freelancer_id' => 3, // Freelancer 2 ID
                'job_title' => 'API Integration Service',
                'price' => 2800000,
                'freelancer_email' => 'freelancer2@test.com',
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1, // Assuming 1 is the client ID
                'freelancer_id' => null, // No freelancer assigned yet
                'job_title' => 'WordPress Website Setup',
                'price' => 2000000,
                'freelancer_email' => null, // Freelancer not assigned
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1, // Assuming 1 is the client ID
                'freelancer_id' => 4, // Freelancer 3 ID
                'job_title' => 'Content Writing for Blog',
                'price' => 1500000,
                'freelancer_email' => 'freelancer3@test.com',
                'status' => 'cancelled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
