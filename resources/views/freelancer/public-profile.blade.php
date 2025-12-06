@extends('layouts.auth')

@section('title', $freelancer->name . ' - Freelancer Profile')
@section('menu-find', 'active')

@section('additional-styles')
<style>
    .profile-header {
        background: white;
        padding: 0;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 2px solid #f5f5f5;
    }

    .profile-header-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 150px;
        position: relative;
    }

    .profile-header-content {
        padding: 0 50px 40px;
        position: relative;
        margin-top: -60px;
    }

    .profile-main-info {
        display: flex;
        align-items: flex-end;
        gap: 25px;
        margin-bottom: 25px;
    }

    .profile-details {
        flex: 1;
        padding-top: 70px;
    }

    .profile-avatar-large {
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 900;
        font-size: 56px;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        flex-shrink: 0;
        border: 5px solid white;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 5px;
        color: #1a1a1a;
    }

    .profile-title {
        font-size: 16px;
        color: #666;
        margin-bottom: 0;
        font-weight: 600;
    }

    .profile-role-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 25px;
        padding: 25px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 16px;
        border: 2px solid rgba(102, 126, 234, 0.1);
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .stat-value {
        font-size: 32px;
        font-weight: 900;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .profile-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 2px solid #f5f5f5;
    }

    .card-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1a1a1a;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
    }

    .info-section {
        margin-bottom: 25px;
    }

    .info-section:last-child {
        margin-bottom: 0;
    }

    .info-label {
        font-size: 13px;
        font-weight: 700;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 16px;
        color: #333;
        font-weight: 600;
        line-height: 1.6;
    }

    .skills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .skill-tag {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        color: #667eea;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
        border: 2px solid #667eea;
    }

    .review-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        border: 2px solid #f0f0f0;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 12px;
    }

    .reviewer-name {
        font-weight: 700;
        color: #333;
        font-size: 15px;
    }

    .review-date {
        font-size: 13px;
        color: #999;
        font-weight: 600;
    }

    .rating {
        color: #ffc107;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .review-text {
        color: #666;
        line-height: 1.6;
        font-size: 14px;
    }

    .contact-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border: 2px solid #667eea;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
    }

    .btn-contact {
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        margin-top: 15px;
    }

    .btn-contact:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-back {
        display: inline-block;
        padding: 12px 24px;
        background: #6c757d;
        color: white;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
        margin-bottom: 20px;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
    }

    .empty-reviews {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    @media (max-width: 968px) {
        .profile-header-content {
            padding: 0 25px 30px;
        }

        .profile-main-info {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-details {
            padding-top: 0;
        }

        .profile-stats {
            grid-template-columns: 1fr;
            padding: 15px;
        }

        .profile-content {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <a href="{{ route('user.find-freelancers') }}" class="btn-back">← Back to Find Freelancers</a>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-header-banner"></div>
        <div class="profile-header-content">
            <div class="profile-main-info">
                <div class="profile-avatar-large">
                    {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                </div>
                <div class="profile-details">
                    <div class="profile-role-badge">FREELANCER</div>
                    <h1 class="profile-name">{{ $freelancer->name }}</h1>
                    <p class="profile-title">{{ $freelancer->job_title ?? 'Professional Freelancer' }}</p>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $completedOrders }}</div>
                    <div class="stat-label">Completed Projects</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $reviews->count() }}</div>
                    <div class="stat-label">Reviews</div>
                </div>
                <div class="stat-item">
                    @if($reviews->count() > 0)
                        <div class="stat-value">{{ number_format($reviews->avg('rating'), 1) }}</div>
                        <div class="stat-label">Average Rating</div>
                    @else
                        <div class="stat-value">-</div>
                        <div class="stat-label">No Ratings Yet</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <!-- Main Info -->
        <div>
            <div class="info-card">
                <h2 class="card-title">About</h2>

                <div class="info-section">
                    <div class="info-label">Bio</div>
                    <div class="info-value">{{ $freelancer->bio ?? 'No bio provided yet.' }}</div>
                </div>

                @if($freelancer->skills)
                    <div class="info-section">
                        <div class="info-label">Skills</div>
                        <div class="skills-grid">
                            @foreach(json_decode($freelancer->skills) ?? [] as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($freelancer->hourly_rate)
                    <div class="info-section">
                        <div class="info-label">Hourly Rate</div>
                        <div class="info-value">${{ number_format($freelancer->hourly_rate, 2) }}/hour</div>
                    </div>
                @endif

                @if($freelancer->experience_years)
                    <div class="info-section">
                        <div class="info-label">Experience</div>
                        <div class="info-value">{{ $freelancer->experience_years }} years</div>
                    </div>
                @endif

                @if($freelancer->location)
                    <div class="info-section">
                        <div class="info-label">Location</div>
                        <div class="info-value">{{ $freelancer->location }}</div>
                    </div>
                @endif
            </div>

            <!-- Reviews -->
            @if($reviews->count() > 0)
                <div class="info-card" style="margin-top: 30px;">
                    <h2 class="card-title">Reviews ({{ $reviews->count() }})</h2>

                    @foreach($reviews as $review)
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-name">{{ $review->user->name }}</div>
                                <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <div class="review-text">{{ $review->comment }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <div class="info-card contact-section">
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: #667eea;">Contact {{ $freelancer->name }}</h3>
                <p style="color: #666; margin-bottom: 10px; font-weight: 600;">Interested in working together?</p>

                @auth
                    <a href="{{ route('chat.show', $freelancer->id) }}" class="btn-contact">
                        💬 Send Message
                    </a>
                    <a href="{{ route('orders.create') }}?freelancer={{ $freelancer->id }}" class="btn-contact">
                        📋 Create Order
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-contact">
                        Login to Contact
                    </a>
                @endauth
            </div>

            @if($reviews->count() === 0)
                <div class="info-card" style="margin-top: 20px;">
                    <h3 class="card-title">Reviews</h3>
                    <div class="empty-reviews">
                        <p>No reviews yet</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
