<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isFreelancer(): bool
    {
        return $this->role === 'freelancer';
    }

    /**
     * Get orders created by this user (as client)
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Get orders assigned to this user (as freelancer)
     */
    public function freelancerOrders()
    {
        return $this->hasMany(Order::class, 'freelancer_id');
    }

    /**
     * Get reviews written by this user (as client)
     */
    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    /**
     * Get reviews received by this user (as freelancer)
     */
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }

    /**
     * Get pending orders for this user
     */
    public function pendingOrders()
    {
        return $this->orders()->where('status', 'pending');
    }

    /**
     * Get completed orders for this user
     */
    public function completedOrders()
    {
        return $this->orders()->where('status', 'completed');
    }

    /**
     * Get total spending (for users)
     */
    public function getTotalSpendingAttribute()
    {
        return $this->orders()->sum('price');
    }

    /**
     * Get total earnings (for freelancers)
     */
    public function getTotalEarningsAttribute()
    {
        return $this->freelancerOrders()->where('status', 'completed')->sum('price');
    }

    /**
     * Get average rating for freelancer
     */
    public function getAverageRatingAttribute()
    {
        return $this->receivedReviews()->published()->avg('rating') ?? 0;
    }

    /**
     * Get average rating percentage (0-100)
     */
    public function getAverageRatingPercentageAttribute()
    {
        $avgRating = $this->average_rating;
        return $avgRating > 0 ? ($avgRating / 5) * 100 : 0;
    }

    /**
     * Get total reviews count
     */
    public function getTotalReviewsAttribute()
    {
        return $this->receivedReviews()->published()->count();
    }

    /**
     * Get reviews breakdown by rating
     */
    public function getReviewsBreakdownAttribute()
    {
        $reviews = $this->receivedReviews()->published();
        $total = $reviews->count();
        
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

        $positive = $reviews->where('rating', '>=', 4)->count();
        $neutral = $reviews->where('rating', 3)->count();
        $negative = $reviews->where('rating', '<', 3)->count();

        return [
            'positive' => $positive,
            'neutral' => $neutral,
            'negative' => $negative,
            'positive_percentage' => round(($positive / $total) * 100, 1),
            'neutral_percentage' => round(($neutral / $total) * 100, 1),
            'negative_percentage' => round(($negative / $total) * 100, 1),
        ];
    }

    /**
     * Get 5-star rating distribution
     */
    public function getRatingDistributionAttribute()
    {
        $reviews = $this->receivedReviews()->published();
        $total = $reviews->count();
        
        if ($total === 0) {
            return [
                5 => 0,
                4 => 0,
                3 => 0,
                2 => 0,
                1 => 0,
            ];
        }

        return [
            5 => round(($reviews->where('rating', 5)->count() / $total) * 100, 1),
            4 => round(($reviews->where('rating', 4)->count() / $total) * 100, 1),
            3 => round(($reviews->where('rating', 3)->count() / $total) * 100, 1),
            2 => round(($reviews->where('rating', 2)->count() / $total) * 100, 1),
            1 => round(($reviews->where('rating', 1)->count() / $total) * 100, 1),
        ];
    }

    /**
     * Get detailed average ratings
     */
    public function getDetailedAverageRatingsAttribute()
    {
        $reviews = $this->receivedReviews()->published();
        
        return [
            'quality' => round($reviews->avg('quality_rating') ?? 0, 2),
            'communication' => round($reviews->avg('communication_rating') ?? 0, 2),
            'deadline' => round($reviews->avg('deadline_rating') ?? 0, 2),
            'professionalism' => round($reviews->avg('professionalism_rating') ?? 0, 2),
        ];
    }

    /**
     * Get star display (★★★★☆)
     */
    public function getStarDisplayAttribute()
    {
        $rating = round($this->average_rating);
        $filled = str_repeat('★', $rating);
        $empty = str_repeat('☆', 5 - $rating);
        return $filled . $empty;
    }

    /**
     * Check if freelancer has excellent rating (4+ stars)
     */
    public function hasExcellentRating()
    {
        return $this->average_rating >= 4;
    }

    /**
     * Get recent reviews (last 5)
     */
    public function getRecentReviewsAttribute()
    {
        return $this->receivedReviews()
            ->published()
            ->with('user', 'order')
            ->latest()
            ->limit(5)
            ->get();
    }
}