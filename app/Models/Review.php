<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'freelancer_id',
        'rating',
        'comment',
        'title',
        'quality_rating',
        'communication_rating',
        'deadline_rating',
        'professionalism_rating',
        'helpful_count',
        'is_verified',
        'is_published',
    ];

    protected $casts = [
        'rating' => 'integer',
        'quality_rating' => 'integer',
        'communication_rating' => 'integer',
        'deadline_rating' => 'integer',
        'professionalism_rating' => 'integer',
        'helpful_count' => 'integer',
        'is_verified' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * Get the order that owns the review.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user who wrote the review (client).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the freelancer who received the review.
     */
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
     * Scope a query to only include published reviews.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include verified reviews.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to filter by rating.
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope a query to filter by minimum rating.
     */
    public function scopeMinRating($query, $minRating)
    {
        return $query->where('rating', '>=', $minRating);
    }

    /**
     * Get the star display (e.g., ⭐⭐⭐⭐⭐).
     */
    public function getStarDisplayAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }

    /**
     * Get the average of all category ratings.
     */
    public function getAverageCategoryRatingAttribute()
    {
        $ratings = array_filter([
            $this->quality_rating,
            $this->communication_rating,
            $this->deadline_rating,
            $this->professionalism_rating,
        ]);

        return !empty($ratings) ? round(array_sum($ratings) / count($ratings), 2) : null;
    }

    /**
     * Check if the review is positive (4-5 stars).
     */
    public function getIsPositiveAttribute()
    {
        return $this->rating >= 4;
    }

    /**
     * Check if the review is neutral (3 stars).
     */
    public function getIsNeutralAttribute()
    {
        return $this->rating === 3;
    }

    /**
     * Check if the review is negative (1-2 stars).
     */
    public function getIsNegativeAttribute()
    {
        return $this->rating <= 2;
    }

    /**
     * Get the sentiment label (Positive/Neutral/Negative).
     */
    public function getSentimentAttribute()
    {
        if ($this->is_positive) {
            return 'Positive';
        } elseif ($this->is_neutral) {
            return 'Neutral';
        } else {
            return 'Negative';
        }
    }

    /**
     * Boot method to auto-update freelancer statistics.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($review) {
            $review->updateFreelancerStats();
        });

        static::updated(function ($review) {
            $review->updateFreelancerStats();
        });

        static::deleted(function ($review) {
            $review->updateFreelancerStats();
        });
    }

    /**
     * Update freelancer's review statistics.
     */
    protected function updateFreelancerStats()
    {
        $freelancer = $this->freelancer;
        
        // Calculate total reviews
        $totalReviews = $freelancer->freelancerReviews()->count();
        
        // Calculate average rating
        $avgRating = $freelancer->freelancerReviews()->avg('rating');
        
        // You can update the user model here if you have these fields
        // $freelancer->update([
        //     'total_reviews' => $totalReviews,
        //     'average_rating' => round($avgRating, 2),
        // ]);
    }

    public function hasDetailedRatings()
{
    return $this->quality_rating !== null ||
           $this->communication_rating !== null ||
           $this->deadline_rating !== null ||
           $this->professionalism_rating !== null;
}
}

