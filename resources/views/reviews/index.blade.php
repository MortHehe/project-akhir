<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews - WORKZY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            padding: 30px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }
        
        .logo {
            padding: 0 30px;
            margin-bottom: 50px;
        }
        
        .logo h2 {
            font-size: 24px;
            font-weight: bold;
        }
        
        .menu-section {
            padding: 0 30px;
            margin-bottom: 30px;
        }
        
        .menu-label {
            color: #999;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        
        .menu-item {
            padding: 12px 30px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #666;
            font-size: 14px;
            text-decoration: none;
        }
        
        .menu-item:hover {
            background: #f5f5f5;
            color: #000;
        }
        
        .menu-item.active {
            background: #000;
            color: white;
            font-weight: 600;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px 40px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 10px 20px;
            border-radius: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: relative;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
        
        .badge {
            background: #4CAF50;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .user-info:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .dropdown-item:hover {
            background: #f5f5f5;
        }
        
        .dropdown-item.logout {
            color: #e74c3c;
        }
        
        .dropdown-item button {
            background: none;
            border: none;
            color: inherit;
            font: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 0;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .page-header p {
            opacity: 0.9;
            font-size: 15px;
        }
        
        /* Stats Overview */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .stat-box .label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .stat-box .value {
            font-size: 36px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .stat-box .subtext {
            font-size: 13px;
            color: #999;
        }
        
        .stat-box .stars {
            color: #ffc107;
            font-size: 20px;
            margin-top: 5px;
        }
        
        /* Filter Section */
        .filter-section {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .filter-row {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            font-size: 12px;
            color: #666;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .filter-tags {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .filter-tag {
            padding: 8px 16px;
            background: #f5f5f5;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }
        
        .filter-tag:hover {
            background: #e0e0e0;
        }
        
        .filter-tag.active {
            background: #667eea;
            color: white;
        }
        
        /* Reviews Container */
        .reviews-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .reviews-header h2 {
            font-size: 20px;
            color: #1a1a1a;
        }
        
        .sort-select {
            padding: 8px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            background: white;
        }
        
        /* Review Item */
        .review-item {
            padding: 25px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .review-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .reviewer-info {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .reviewer-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 20px;
        }
        
        .reviewer-details h3 {
            font-size: 16px;
            margin-bottom: 3px;
            color: #1a1a1a;
        }
        
        .reviewer-details .order-title {
            font-size: 13px;
            color: #666;
        }
        
        .review-rating {
            text-align: right;
        }
        
        .review-rating .stars {
            color: #ffc107;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .review-rating .rating-number {
            font-size: 14px;
            color: #666;
            font-weight: 600;
        }
        
        .review-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        .review-comment {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .detailed-ratings {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .rating-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .rating-item .label {
            font-size: 12px;
            color: #666;
            font-weight: 600;
        }
        
        .rating-bar {
            height: 6px;
            background: #e0e0e0;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .rating-bar-fill {
            height: 100%;
            background: #667eea;
            transition: width 0.3s;
        }
        
        .rating-item .value {
            font-size: 12px;
            color: #999;
        }
        
        .review-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }
        
        .review-meta {
            display: flex;
            gap: 20px;
            font-size: 13px;
            color: #999;
            flex-wrap: wrap;
        }
        
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .review-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-helpful {
            padding: 8px 16px;
            background: #f0f0f0;
            color: #666;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-helpful:hover {
            background: #667eea;
            color: white;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-state .icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #1a1a1a;
        }
        
        .empty-state p {
            color: #666;
            font-size: 14px;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
        }
        
        .pagination a,
        .pagination span {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .pagination a:hover {
            border-color: #667eea;
            color: #667eea;
        }
        
        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        @media (max-width: 1024px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .stats-row {
                grid-template-columns: 1fr;
            }
            
            .filter-row {
                flex-direction: column;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .detailed-ratings {
                grid-template-columns: 1fr;
            }
            
            .review-header {
                flex-direction: column;
                gap: 15px;
            }
            
            .review-rating {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>⚫ WORKZY</h2>
            </div>
            
            <nav class="menu">
                <div class="menu-section">
                    <div class="menu-label">Menu</div>
                    <a href="{{ route('freelancer.dashboard') }}" class="menu-item">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('freelancer.index') }}" class="menu-item">
                        <span>📦</span> My Orders
                    </a>
                    <a href="{{ route('reviews.index') }}" class="menu-item active">
                        <span>⭐</span> Reviews
                    </a>
                </div>
                
                <div class="menu-section">
                    <div class="menu-label">Others</div>
                    <a href="#" class="menu-item">
                        <span>⚙️</span> Settings
                    </a>
                    <a href="#" class="menu-item">
                        <span>💰</span> Earnings
                    </a>
                    <a href="#" class="menu-item">
                        <span>👤</span> Profile
                    </a>
                </div>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="header">
                <div></div>
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                    <span class="badge">Freelancer</span>
                    <span>▼</span>
                    
                    <div class="dropdown-menu">
                        <a href="{{ route('freelancer.dashboard') }}" class="dropdown-item">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="#" class="dropdown-item">
                            <span>👤</span> My Profile
                        </a>
                        <div class="dropdown-item logout">
                            <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                                @csrf
                                <button type="submit">
                                    <span>🚪</span> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-header">
                <h1>⭐ Your Reviews</h1>
                <p>See what your clients are saying about your work</p>
            </div>
            
            @php
                $user = auth()->user();
                $avgRating = $user->average_rating;
                $totalReviews = $user->total_reviews;
                $breakdown = $user->reviews_breakdown;
                $distribution = $user->rating_distribution ?? ['5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0];
                $detailedAvg = $user->detailed_average_ratings ?? [
                    'quality' => 0,
                    'communication' => 0,
                    'deadline' => 0,
                    'professionalism' => 0
                ];
            @endphp
            
            <!-- Stats Overview -->
            <div class="stats-row">
                <div class="stat-box">
                    <div class="label">Average Rating</div>
                    <div class="value">{{ number_format($avgRating, 1) }}</div>
                    <div class="stars">{{ str_repeat('★', round($avgRating)) }}{{ str_repeat('☆', 5 - round($avgRating)) }}</div>
                    <div class="subtext">Out of 5.0</div>
                </div>
                
                <div class="stat-box">
                    <div class="label">Total Reviews</div>
                    <div class="value">{{ $totalReviews }}</div>
                    <div class="subtext">All time feedback</div>
                </div>
                
                <div class="stat-box">
                    <div class="label">Positive Reviews</div>
                    <div class="value">{{ $breakdown['positive_percentage'] }}%</div>
                    <div class="subtext">{{ $breakdown['positive'] }} positive ratings</div>
                </div>
                
                <div class="stat-box">
                    <div class="label">Recent Rating</div>
                    <div class="value">{{ $reviews->take(5)->avg('rating') ? number_format($reviews->take(5)->avg('rating'), 1) : 'N/A' }}</div>
                    <div class="subtext">Last 5 reviews</div>
                </div>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-section">
                <form method="GET" action="{{ route('reviews.index') }}" id="filterForm">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label>Filter by Rating</label>
                            <select name="rating" onchange="document.getElementById('filterForm').submit()">
                                <option value="">All Ratings</option>
                                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label>Verification Status</label>
                            <select name="verified" onchange="document.getElementById('filterForm').submit()">
                                <option value="">All Reviews</option>
                                <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Verified Only</option>
                                <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Unverified</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label>Search</label>
                            <input type="text" name="search" placeholder="Search reviews..." value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <div class="filter-tags">
                        <button type="button" class="filter-tag {{ request('rating') == '' ? 'active' : '' }}" onclick="window.location='{{ route('reviews.index') }}'">
                            All Reviews
                        </button>
                        <button type="button" class="filter-tag {{ request('rating') == '5' ? 'active' : '' }}" onclick="window.location='{{ route('reviews.index', ['rating' => 5]) }}'">
                            ⭐ 5 Stars
                        </button>
                        <button type="button" class="filter-tag {{ request('rating') == '4' ? 'active' : '' }}" onclick="window.location='{{ route('reviews.index', ['rating' => 4]) }}'">
                            ⭐ 4 Stars
                        </button>
                        <button type="button" class="filter-tag {{ request('rating') >= '3' && request('rating') <= '3' ? 'active' : '' }}" onclick="window.location='{{ route('reviews.index', ['rating' => 3]) }}'">
                            ⭐ 3 Stars & Below
                        </button>
                        <button type="button" class="filter-tag {{ request('verified') == '1' ? 'active' : '' }}" onclick="window.location='{{ route('reviews.index', ['verified' => 1]) }}'">
                            ✓ Verified
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Reviews List -->
            <div class="reviews-container">
                <div class="reviews-header">
                    <h2>💬 All Reviews ({{ $reviews->total() }})</h2>
                    <select class="sort-select" onchange="window.location='?sort=' + this.value + '{{ request('rating') ? '&rating=' . request('rating') : '' }}{{ request('verified') ? '&verified=' . request('verified') : '' }}'">
                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rating</option>
                        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
                    </select>
                </div>
                
                @forelse($reviews as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">{{ substr($review->user->name, 0, 1) }}</div>
                                <div class="reviewer-details">
                                    <h3>{{ $review->user->name }}</h3>
                                    <div class="order-title">{{ $review->order->job_title }}</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <div class="stars">{{ $review->star_display }}</div>
                                <div class="rating-number">{{ $review->rating }}/5</div>
                            </div>
                        </div>
                        
                        @if($review->title)
                            <div class="review-title">{{ $review->title }}</div>
                        @endif
                        
                        @if($review->comment)
                            <div class="review-comment">{{ $review->comment }}</div>
                        @endif
                        
                        @if($review->hasDetailedRatings())
                            <div class="detailed-ratings">
                                @if($review->quality_rating)
                                    <div class="rating-item">
                                        <div class="label">Quality</div>
                                        <div class="rating-bar">
                                            <div class="rating-bar-fill" style="width: {{ ($review->quality_rating / 5) * 100 }}%"></div>
                                        </div>
                                        <div class="value">{{ $review->quality_rating }}/5</div>
                                    </div>
                                @endif
                                
                                @if($review->communication_rating)
                                    <div class="rating-item">
                                        <div class="label">Communication</div>
                                        <div class="rating-bar">
                                            <div class="rating-bar-fill" style="width: {{ ($review->communication_rating / 5) * 100 }}%"></div>
                                        </div>
                                        <div class="value">{{ $review->communication_rating }}/5</div>
                                    </div>
                                @endif
                                
                                @if($review->deadline_rating)
                                    <div class="rating-item">
                                        <div class="label">Deadline</div>
                                        <div class="rating-bar">
                                            <div class="rating-bar-fill" style="width: {{ ($review->deadline_rating / 5) * 100 }}%"></div>
                                        </div>
                                        <div class="value">{{ $review->deadline_rating }}/5</div>
                                    </div>
                                @endif
                                
                                @if($review->professionalism_rating)
                                    <div class="rating-item">
                                        <div class="label">Professionalism</div>
                                        <div class="rating-bar">
                                            <div class="rating-bar-fill" style="width: {{ ($review->professionalism_rating / 5) * 100 }}%"></div>
                                        </div>
                                        <div class="value">{{ $review->professionalism_rating }}/5</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        
                        <div class="review-footer">
                            <div class="review-meta">
                                <span>📅 {{ $review->created_at->format('M d, Y') }}</span>
                                <span>💼 Order #{{ $review->order_id }}</span>
                                @if($review->is_verified)
                                    <span class="verified-badge">✓ Verified Review</span>
                                @endif
                            </div>
                            <div class="review-actions">
                                <form method="POST" action="{{ route('reviews.helpful', $review) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-helpful">
                                        👍 Helpful ({{ $review->helpful_count }})
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="icon">⭐</div>
                        <h3>No Reviews Yet</h3>
                        <p>You haven't received any reviews yet. Keep delivering excellent work!</p>
                    </div>
                @endforelse
                
                @if($reviews->hasPages())
                    <div class="pagination">
                        {{-- Previous Page Link --}}
                        @if($reviews->onFirstPage())
                            <span class="disabled">← Previous</span>
                        @else
                            <a href="{{ $reviews->previousPageUrl() }}">← Previous</a>
                        @endif
                        
                        {{-- Pagination Elements --}}
                        @foreach($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                            @if($page == $reviews->currentPage())
                                <span class="active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        {{-- Next Page Link --}}
                        @if($reviews->hasMorePages())
                            <a href="{{ $reviews->nextPageUrl() }}">Next →</a>
                        @else
                            <span class="disabled">Next →</span>
                        @endif
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>