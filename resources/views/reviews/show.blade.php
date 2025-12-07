@extends('layouts.auth')

@section('title', 'Review Details')

@section('additional-styles')
<style>
    .review-detail-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        max-width: 900px;
        margin: 0 auto;
        border: 2px solid #f5f5f5;
    }

    .review-header {
        padding-bottom: 25px;
        margin-bottom: 30px;
        border-bottom: 3px solid #667eea;
    }

    .review-meta {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .reviewer-info h1 {
        font-size: 28px;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .reviewer-name {
        font-size: 16px;
        color: #666;
        font-weight: 600;
    }

    .review-date {
        font-size: 14px;
        color: #999;
        font-weight: 600;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .stars-large {
        color: #ffc107;
        font-size: 32px;
        letter-spacing: 3px;
    }

    .rating-number {
        font-size: 24px;
        font-weight: 900;
        color: #667eea;
    }

    .order-info-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 30px;
        border: 2px solid rgba(102, 126, 234, 0.2);
    }

    .order-info-box h3 {
        font-size: 16px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 12px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    .review-content {
        margin-bottom: 30px;
    }

    .review-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .review-comment {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .helpful-section {
        background: #f8f9fa;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 2px solid #e9ecef;
    }

    .helpful-text {
        font-size: 14px;
        color: #666;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .helpful-count {
        font-size: 18px;
        font-weight: 700;
        color: #667eea;
    }

    .btn-helpful {
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-helpful:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-helpful:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .btn-order {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 2px solid #c3e6cb;
    }

    .published-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-published {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .badge-unpublished {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe89a 100%);
        color: #856404;
    }

    @media (max-width: 768px) {
        .review-detail-card {
            padding: 25px 20px;
        }

        .review-meta {
            flex-direction: column;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="review-detail-card">
        <div class="review-header">
            <div class="review-meta">
                <div class="reviewer-info">
                    @if($review->title)
                        <h1>{{ $review->title }}</h1>
                    @else
                        <h1>Review for {{ $review->order->job_title }}</h1>
                    @endif
                    <div class="reviewer-name">
                        By {{ $review->user->name }}
                    </div>
                    <div class="review-date">
                        {{ $review->created_at->format('F d, Y') }} • {{ $review->created_at->diffForHumans() }}
                    </div>
                </div>
                <div>
                    <div class="rating-display">
                        <div class="stars-large">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <span class="rating-number">{{ $review->rating }}/5</span>
                    </div>
                    <div style="margin-top: 10px;">
                        <span class="published-badge {{ $review->is_published ? 'badge-published' : 'badge-unpublished' }}">
                            {{ $review->is_published ? 'Published' : 'Unpublished' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-info-box">
            <h3>📋 Order Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Project</span>
                    <span class="info-value">{{ $review->order->job_title }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Freelancer</span>
                    <span class="info-value">{{ $review->freelancer->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Order ID</span>
                    <span class="info-value">#{{ $review->order->id }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Completed</span>
                    <span class="info-value">{{ $review->order->completed_at ? $review->order->completed_at->format('M d, Y') : 'N/A' }}</span>
                </div>
            </div>
        </div>

        <div class="review-content">
            @if($review->title)
                <h2 class="review-title">{{ $review->title }}</h2>
            @endif
            <div class="review-comment">{{ $review->comment }}</div>
        </div>

        @if($review->helpful_count > 0 || Auth::check())
            <div class="helpful-section">
                <div class="helpful-text">
                    Was this review helpful?
                </div>
                @if($review->helpful_count > 0)
                    <div class="helpful-count">
                        👍 {{ $review->helpful_count }} {{ Str::plural('person', $review->helpful_count) }} found this helpful
                    </div>
                @endif
                @auth
                    @if(Auth::id() !== $review->user_id)
                        <form action="{{ route('reviews.helpful', $review) }}" method="POST" style="margin-top: 15px;">
                            @csrf
                            <button type="submit" class="btn-helpful">
                                👍 Mark as Helpful
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        @endif

        <div class="action-buttons">
            <a href="{{ url()->previous() }}" class="btn btn-back">
                ← Back
            </a>
            <a href="{{ route('orders.show', $review->order) }}" class="btn btn-order">
                📋 View Order
            </a>
        </div>
    </div>
@endsection
