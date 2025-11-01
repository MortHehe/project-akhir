<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'quality_rating' => 'integer',
        'communication_rating' => 'integer',
        'deadline_rating' => 'integer',
        'professionalism_rating' => 'integer',
        'helpful_count' => 'integer',
        'is_verified' => 'boolean',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the order that owns the review.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user (client) who wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the freelancer being reviewed.
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
     * Get rating percentage (for display)
     */
    public function getRatingPercentageAttribute()
    {
        return ($this->rating / 5) * 100;
    }

    /**
     * Get average of detailed ratings
     */
    public function getAverageDetailedRatingAttribute()
    {
        $ratings = array_filter([
            $this->quality_rating,
            $this->communication_rating,
            $this->deadline_rating,
            $this->professionalism_rating,
        ]);
        
        return $ratings ? round(array_sum($ratings) / count($ratings), 2) : $this->rating;
    }

    /**
     * Get star display (★★★★☆)
     */
    public function getStarDisplayAttribute()
    {
        $filled = str_repeat('★', $this->rating);
        $empty = str_repeat('☆', 5 - $this->rating);
        return $filled . $empty;
    }

    /**
     * Check if review has detailed ratings
     */
    public function hasDetailedRatings()
    {
        return $this->quality_rating !== null ||
               $this->communication_rating !== null ||
               $this->deadline_rating !== null ||
               $this->professionalism_rating !== null;
    }

    /**
     * Get rating color class
     */
    public function getRatingColorAttribute()
    {
        return match(true) {
            $this->rating >= 4 => 'success',
            $this->rating >= 3 => 'warning',
            default => 'danger',
        };
    }

    /**
     * Get rating sentiment
     */
    public function getRatingSentimentAttribute()
    {
        return match(true) {
            $this->rating >= 4 => 'Positive',
            $this->rating >= 3 => 'Neutral',
            default => 'Negative',
        };
    }
}