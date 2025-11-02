<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ... your existing code (fillable, hidden, casts, etc.) ...

    /**
     * Get all reviews written by this user (as a client).
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    /**
     * Get all reviews received by this user (as a freelancer).
     */
    public function freelancerReviews()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }

    /**
     * Get published reviews only.
     */
    public function publishedReviews()
    {
        return $this->freelancerReviews()->published();
    }

    /**
     * Get orders where this user is the freelancer.
     */
    public function freelancerOrders()
    {
        return $this->hasMany(Order::class, 'freelancer_id');
    }

    /**
     * Get orders where this user is the client.
     */
    public function clientOrders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Get the average rating for this freelancer.
     */
    public function getAverageRatingAttribute()
    {
        return round($this->freelancerReviews()->avg('rating') ?? 0, 2);
    }

    /**
     * Get total number of reviews.
     */
    public function getTotalReviewsAttribute()
    {
        return $this->freelancerReviews()->count();
    }

    /**
     * Get star display based on average rating.
     */
    public function getStarDisplayAttribute()
    {
        return str_repeat('⭐', round($this->average_rating));
    }

    /**
     * Get total earnings from completed orders.
     */
    public function getTotalEarningsAttribute()
    {
        return $this->freelancerOrders()
            ->where('status', 'completed')
            ->sum('price');
    }

    /**
     * Get recent reviews (last 5).
     */
    public function getRecentReviewsAttribute()
    {
        return $this->freelancerReviews()
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();
    }

    /**
     * Get review breakdown (positive, neutral, negative).
     */
    public function getReviewsBreakdownAttribute()
    {
        $total = $this->total_reviews;
        
        if ($total === 0) {
            return [
                'positive' => 0,
                'neutral' => 0,
                'negative' => 0,
                'positive_percentage' => 0,
                'neutral_percentage' => 0,
                'negative_percentage' => 0,
            ];
        }
        
        $positive = $this->freelancerReviews()->where('rating', '>=', 4)->count();
        $neutral = $this->freelancerReviews()->where('rating', 3)->count();
        $negative = $this->freelancerReviews()->where('rating', '<=', 2)->count();
        
        return [
            'positive' => $positive,
            'neutral' => $neutral,
            'negative' => $negative,
            'positive_percentage' => round(($positive / $total) * 100),
            'neutral_percentage' => round(($neutral / $total) * 100),
            'negative_percentage' => round(($negative / $total) * 100),
        ];
    }

    /**
     * Get rating distribution (count of each rating 1-5).
     */
    public function getRatingDistributionAttribute()
    {
        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = $this->freelancerReviews()->where('rating', $i)->count();
        }
        return $distribution;
    }

    /**
     * Get average category ratings.
     */
    public function getDetailedAverageRatingsAttribute()
    {
        $reviews = $this->freelancerReviews;
        
        return [
            'quality' => round($reviews->avg('quality_rating') ?? 0, 1),
            'communication' => round($reviews->avg('communication_rating') ?? 0, 1),
            'deadline' => round($reviews->avg('deadline_rating') ?? 0, 1),
            'professionalism' => round($reviews->avg('professionalism_rating') ?? 0, 1),
        ];
    }

    /**
     * Check if user is a freelancer.
     */
    public function isFreelancer()
    {
        return $this->role === 'freelancer';
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}