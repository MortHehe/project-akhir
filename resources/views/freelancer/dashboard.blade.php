@extends('layouts.auth')

@section('title', 'Freelancer Dashboard')
@section('menu-dashboard', 'active')

@section('additional-styles')
<style>
    .sections-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    .order-list {
        list-style: none;
    }

    .order-item {
        padding: 22px;
        border: 2px solid #f0f0f0;
        border-radius: 14px;
        margin-bottom: 16px;
        transition: all 0.3s ease;
        background: white;
    }

    .order-item:hover {
        border-color: #667eea;
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.12);
        transform: translateX(8px);
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.02) 0%, rgba(118, 75, 162, 0.02) 100%);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .order-title {
        font-weight: 700;
        font-size: 16px;
        color: #1a1a1a;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-paid { background: #d4edda; color: #155724; }
    .status-accepted { background: #d1ecf1; color: #0c5460; }
    .status-in_progress { background: #cfe2ff; color: #084298; }
    .status-completed { background: #d1e7dd; color: #0f5132; }

    .order-meta {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #666;
        margin-top: 10px;
    }

    .rating-section {
        margin-top: 25px;
    }

    .rating-circles {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .rating-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        transition: all 0.3s;
    }

    .rating-circle:hover {
        transform: scale(1.1);
    }

    .rating-circle.positive { background: linear-gradient(135deg, #4CAF50, #45a049); color: white; }
    .rating-circle.neutral { background: linear-gradient(135deg, #e2e3e5, #d1d3d6); color: #333; }
    .rating-circle.negative { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }

    .rating-circle .percent {
        font-size: 22px;
    }

    .rating-circle .label {
        font-size: 10px;
        text-transform: uppercase;
        margin-top: 5px;
        opacity: 0.9;
    }

    .reviews-list {
        list-style: none;
    }

    .review-item {
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .review-item:last-child {
        border-bottom: none;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .review-stars {
        color: #ffc107;
        font-size: 16px;
    }

    .review-comment {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
    }

    .view-all-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #667eea;
        font-weight: 700;
        text-decoration: none;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .view-all-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    @media (max-width: 1200px) {
        .sections-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>Welcome back, {{ auth()->user()->name }}! 💼</h1>
        <p>Here's your freelance performance overview</p>
    </div>

    @php
        $user = auth()->user();
        $activeOrders = $user->freelancerOrders()->whereIn('status', ['accepted', 'in_progress'])->count();
        $completedOrders = $user->freelancerOrders()->where('status', 'completed')->count();
        $totalEarnings = $user->total_earnings ?? 0;
        $totalReviews = $user->total_reviews ?? 0;
        $avgRating = $user->average_rating ?? 0;
        $breakdown = $user->reviews_breakdown ?? ['positive_percentage' => 0, 'neutral_percentage' => 0, 'negative_percentage' => 0];
    @endphp

    <div class="stats-grid">
        <div class="stat-card">
            <span class="icon">📊</span>
            <h3>Active Projects</h3>
            <div class="number">{{ $activeOrders }}</div>
            <div class="change">Currently working</div>
        </div>
        <div class="stat-card">
            <span class="icon">✅</span>
            <h3>Completed Projects</h3>
            <div class="number">{{ $completedOrders }}</div>
            <div class="change">Successfully delivered</div>
        </div>
        <div class="stat-card">
            <span class="icon">💰</span>
            <h3>Total Earnings</h3>
            <div class="number">IDR {{ number_format($totalEarnings, 0, ',', '.') }}</div>
            <div class="change">Lifetime earnings</div>
        </div>
        <div class="stat-card">
            <span class="icon">⭐</span>
            <h3>Average Rating</h3>
            <div class="number">{{ number_format($avgRating, 1) }}/5</div>
            <div class="change">From {{ $totalReviews }} reviews</div>
        </div>
    </div>

    <div class="sections-grid">
        <div class="card">
            <h2>🔥 Recent Orders</h2>
            <ul class="order-list">
                @forelse($user->freelancerOrders()->with('user')->latest()->limit(5)->get() as $order)
                    <li class="order-item">
                        <div class="order-header">
                            <div class="order-title">{{ $order->job_title }}</div>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <p style="color: #666; font-size: 14px; margin-bottom: 10px;">
                            {{ Str::limit($order->job_description, 100) }}
                        </p>
                        <div class="order-meta">
                            <span>👤 {{ $order->user->name }}</span>
                            <span>💵 ${{ number_format($order->price, 2) }}</span>
                            <span>📅 {{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($order->status === 'pending' || $order->status === 'paid')
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary" style="margin-top: 15px; display: inline-block; text-decoration: none; padding: 10px 20px; font-size: 14px;">View Details</a>
                        @endif
                    </li>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">📋</div>
                        <p>No orders yet. Keep your profile updated!</p>
                    </div>
                @endforelse
            </ul>
            @if($user->freelancerOrders()->count() > 0)
                <a href="{{ route('freelancer.index') }}" class="view-all-link">View All Orders →</a>
            @endif
        </div>

        <div class="card">
            <h2>⭐ Your Ratings</h2>
            <div class="rating-section">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="font-size: 48px; font-weight: bold;">{{ number_format($avgRating, 1) }}</div>
                    <div style="color: #ffc107; font-size: 24px;">{{ $user->star_display ?? '☆☆☆☆☆' }}</div>
                    <div style="color: #666; font-size: 14px;">Based on {{ $totalReviews }} reviews</div>
                </div>

                <div class="rating-circles">
                    <div class="rating-circle positive">
                        <div class="percent">{{ $breakdown['positive_percentage'] }}%</div>
                        <div class="label">Positive</div>
                    </div>
                    <div class="rating-circle neutral">
                        <div class="percent">{{ $breakdown['neutral_percentage'] }}%</div>
                        <div class="label">Neutral</div>
                    </div>
                    <div class="rating-circle negative">
                        <div class="percent">{{ $breakdown['negative_percentage'] }}%</div>
                        <div class="label">Negative</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <h2>💬 Recent Reviews</h2>
        <ul class="reviews-list">
            @forelse($user->recent_reviews ?? [] as $review)
                <li class="review-item">
                    <div class="review-header">
                        <strong>{{ $review->user->name }}</strong>
                        <span class="review-stars">{{ $review->star_display }}</span>
                    </div>
                    @if($review->title)
                        <div style="font-weight: 600; margin-bottom: 5px;">{{ $review->title }}</div>
                    @endif
                    <p class="review-comment">{{ $review->comment }}</p>
                    <div style="font-size: 12px; color: #999; margin-top: 5px;">
                        {{ $review->created_at->diffForHumans() }}
                    </div>
                </li>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">⭐</div>
                    <p>No reviews yet. Complete projects to get reviews!</p>
                </div>
            @endforelse
        </ul>
        @if(($user->recent_reviews ?? collect())->count() > 0)
            <a href="{{ route('reviews.index') }}" class="view-all-link">View All Reviews →</a>
        @endif
    </div>
@endsection
