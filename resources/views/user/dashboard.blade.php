<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard - WORKZY</title>
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
        
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .dashboard-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .stat-card .change {
            font-size: 14px;
            color: #4CAF50;
            margin-top: 5px;
        }
        
        .sections-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .card h2 {
            margin-bottom: 20px;
            color: #1a1a1a;
            font-size: 20px;
        }
        
        .order-list {
            list-style: none;
        }
        
        .order-item {
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        
        .order-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .order-title {
            font-weight: 600;
            font-size: 16px;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-accepted { background: #d1ecf1; color: #0c5460; }
        .status-in_progress { background: #cfe2ff; color: #084298; }
        .status-completed { background: #d1e7dd; color: #0f5132; }
        
        .order-meta {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }
        
        .rating-section {
            margin-top: 20px;
        }
        
        .rating-circles {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .rating-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .rating-circle.positive { background: #d1e7dd; color: #0f5132; }
        .rating-circle.neutral { background: #e2e3e5; color: #41464b; }
        .rating-circle.negative { background: #2c3136; color: white; }
        
        .rating-circle .percent {
            font-size: 24px;
        }
        
        .rating-circle .label {
            font-size: 11px;
            text-transform: uppercase;
            margin-top: 5px;
        }
        
        .reviews-list {
            list-style: none;
        }
        
        .review-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .review-stars {
            color: #ffc107;
        }
        
        .review-comment {
            color: #666;
            font-size: 14px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
        }
        
        @media (max-width: 1200px) {
            .sections-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
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
                    <a href="{{ route('freelancer.dashboard') }}" class="menu-item active">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('projects.index') }}" class="menu-item">
                        <span>📦</span> My Project
                    </a>
                    <a href="{{ route('reviews.index') }}" class="menu-item">
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
                    <span class="badge">User</span>
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
            
            <div class="dashboard-header">
                <h1>Welcome back, {{ auth()->user()->name }}! 💼</h1>
                <p>Here's your performance overview</p>
            </div>
            
            @php
                $user = auth()->user();
                $activeOrders = $user->freelancerOrders()->whereIn('status', ['accepted', 'in_progress'])->count();
                $completedOrders = $user->freelancerOrders()->where('status', 'completed')->count();
                $totalEarnings = $user->total_earnings;
                $totalReviews = $user->total_reviews;
                $avgRating = $user->average_rating;
                $breakdown = $user->reviews_breakdown;
            @endphp
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Active Projects</h3>
                    <div class="number">{{ $activeOrders }}</div>
                    <div class="change">📊 In progress</div>
                </div>
                <div class="stat-card">
                    <h3>Completed Projects</h3>
                    <div class="number">{{ $completedOrders }}</div>
                    <div class="change">✅ Total completed</div>
                </div>
                <div class="stat-card">
                    <h3>Total Earnings</h3>
                    <div class="number">IDR {{ number_format($totalEarnings, 0, ',', '.') }}</div>
                    <div class="change">💰 Lifetime earnings</div>
                </div>
                <div class="stat-card">
                    <h3>Average Rating</h3>
                    <div class="number">{{ number_format($avgRating, 1) }}/5</div>
                    <div class="change">⭐ From {{ $totalReviews }} reviews</div>
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
                                    <span>💵 {{ $order->formatted_price }}</span>
                                    <span>📅 {{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                @if($order->status === 'pending')
                                    <button class="btn btn-primary" style="margin-top: 10px;">Accept Order</button>
                                @endif
                            </li>
                        @empty
                            <p style="color: #999; text-align: center; padding: 20px;">No orders yet</p>
                        @endforelse
                    </ul>
                    <a href="{{ route('orders.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #667eea; font-weight: 600;">View All Orders →</a>
                </div>
                
                <div class="card">
                    <h2>⭐ Your Ratings</h2>
                    <div class="rating-section">
                        <div style="text-align: center; margin-bottom: 20px;">
                            <div style="font-size: 48px; font-weight: bold;">{{ number_format($avgRating, 1) }}</div>
                            <div style="color: #ffc107; font-size: 24px;">{{ $user->star_display }}</div>
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
                    @forelse($user->recent_reviews as $review)
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
                        <p style="color: #999; text-align: center; padding: 20px;">No reviews yet</p>
                    @endforelse
                </ul>
                <a href="{{ route('reviews.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #667eea; font-weight: 600;">View All Reviews →</a>
            </div>
        </main>
    </div>
</body>
</html>