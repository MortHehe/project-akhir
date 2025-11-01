<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // Order and User Information
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Reviewer (client)
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade'); // Reviewed (freelancer)
            
            // Rating (1-5 stars)
            $table->unsignedTinyInteger('rating')->comment('Rating from 1 to 5');
            
            // Review Details
            $table->text('comment')->nullable();
            $table->string('title')->nullable();
            
            // Review Categories (Optional - for detailed feedback)
            $table->unsignedTinyInteger('quality_rating')->nullable()->comment('Quality of work: 1-5');
            $table->unsignedTinyInteger('communication_rating')->nullable()->comment('Communication: 1-5');
            $table->unsignedTinyInteger('deadline_rating')->nullable()->comment('Meeting deadline: 1-5');
            $table->unsignedTinyInteger('professionalism_rating')->nullable()->comment('Professionalism: 1-5');
            
            // Helpful votes
            $table->unsignedInteger('helpful_count')->default(0);
            
            // Status
            $table->boolean('is_verified')->default(false)->comment('Admin verified review');
            $table->boolean('is_published')->default(true)->comment('Review is visible');
            
            // Timestamps
            $table->timestamps();
            
            // Indexes
            $table->index('order_id');
            $table->index('user_id');
            $table->index('freelancer_id');
            $table->index('rating');
            
            // One review per order
            $table->unique('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};