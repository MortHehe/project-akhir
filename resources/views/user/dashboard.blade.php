<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - WORKZY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9ff;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            padding: 30px 0;
            box-shadow: 4px 0 20px rgba(102, 126, 234, 0.1);
            color: white;
        }

        .logo {
            padding: 0 30px;
            margin-bottom: 50px;
        }

        .logo h2 {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -1px;
            color: white;
        }

        .menu-section {
            padding: 0 15px;
            margin-bottom: 30px;
        }

        .menu-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 1.5px;
            padding: 0 15px;
        }

        .menu-item {
            padding: 14px 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            text-decoration: none;
            position: relative;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .menu-item .notification-badge {
            position: absolute;
            right: 15px;
            background: #ff4757;
            color: white;
            font-size: 11px;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
            box-shadow: 0 2px 8px rgba(255, 71, 87, 0.4);
        }

        .menu-item.active .notification-badge {
            background: #667eea;
            color: white;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .menu-item.active {
            background: white;
            color: #667eea;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px 50px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .back-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 12px 24px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            position: relative;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-info:hover {
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.15);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }

        .badge {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 15px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            min-width: 240px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow: hidden;
        }

        .user-info:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
            border-bottom: 1px solid #f5f5f5;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .dropdown-item.logout {
            color: #e74c3c;
            border-bottom: none;
        }

        .dropdown-item.logout:hover {
            background: #e74c3c;
            color: white;
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
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .dashboard-header > * {
            position: relative;
            z-index: 1;
        }

        .dashboard-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .dashboard-header p {
            font-size: 16px;
            opacity: 0.95;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .stat-card h3 {
            color: #999;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .number {
            font-size: 40px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-card .change {
            font-size: 14px;
            color: #4CAF50;
            font-weight: 600;
        }

        .sections-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }

        .card h2 {
            margin-bottom: 25px;
            color: #1a1a1a;
            font-size: 22px;
            font-weight: 800;
        }

        .order-list {
            list-style: none;
        }

        .order-item {
            padding: 20px;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: all 0.3s;
            background: #fafbff;
        }

        .order-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
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

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
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

            .dashboard-header h1 {
                font-size: 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
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
                    <a href="{{ route('user.dashboard') }}" class="menu-item active">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('orders.index') }}" class="menu-item">
                        <span>📂</span> My Orders
                    </a>
                    <a href="{{ route('find-freelancers') }}" class="menu-item">
                        <span>🔍</span> Find Freelancers
                    </a>
                    <a href="{{ route('chat.index') }}" class="menu-item">
                        <span>💬</span> Messages
                        @php
                            $unreadCount = App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="notification-badge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                        @endif
                    </a>
                </div>

                <div class="menu-section">
                    <div class="menu-label">Account</div>
                    <a href="{{ route('user.profile') }}" class="menu-item">
                        <span>👤</span> Profile
                    </a>
                    <a href="{{ route('user.payments') }}" class="menu-item">
                        <span>💰</span> Payments
                    </a>
                    <a href="{{ route('user.settings') }}" class="menu-item">
                        <span>⚙️</span> Settings
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <a href="{{ route('welcome') }}" class="back-home">
                    <span>←</span> Back to Home
                </a>
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <span style="font-weight: 600;">{{ auth()->user()->name }}</span>
                    <span class="badge">Client</span>
                    <span style="opacity: 0.5;">▼</span>

                    <div class="dropdown-menu">
                        <a href="{{ route('user.dashboard') }}" class="dropdown-item">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('user.profile') }}" class="dropdown-item">
                            <span>👤</span> My Profile
                        </a>
                        <a href="{{ route('user.settings') }}" class="dropdown-item">
                            <span>⚙️</span> Settings
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
                <h1>Welcome back, {{ auth()->user()->name }}! 👋</h1>
                <p>Manage your projects and connect with top freelancers</p>
            </div>

            @php
                $user = auth()->user();
                $activeOrders = $user->clientOrders()->whereIn('status', ['paid', 'accepted', 'in_progress'])->count();
                $completedOrders = $user->clientOrders()->where('status', 'completed')->count();
                $pendingOrders = $user->clientOrders()->where('status', 'pending')->count();
                $totalSpent = $user->clientOrders()->where('status', 'completed')->sum('price');
            @endphp

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Active Projects</h3>
                    <div class="number">{{ $activeOrders }}</div>
                    <div class="change">📊 Currently in progress</div>
                </div>
                <div class="stat-card">
                    <h3>Completed Projects</h3>
                    <div class="number">{{ $completedOrders }}</div>
                    <div class="change">✅ Successfully delivered</div>
                </div>
                <div class="stat-card">
                    <h3>Pending Orders</h3>
                    <div class="number">{{ $pendingOrders }}</div>
                    <div class="change">⏳ Awaiting payment</div>
                </div>
                <div class="stat-card">
                    <h3>Total Spent</h3>
                    <div class="number">${{ number_format($totalSpent, 0) }}</div>
                    <div class="change">💰 Lifetime spending</div>
                </div>
            </div>

            <div class="sections-grid">
                <div class="card">
                    <h2>🔥 Recent Orders</h2>
                    <ul class="order-list">
                        @forelse($user->clientOrders()->with('freelancer')->latest()->limit(5)->get() as $order)
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
                                    @if($order->freelancer)
                                        <span>👤 {{ $order->freelancer->name }}</span>
                                    @else
                                        <span>👥 Open to all</span>
                                    @endif
                                    <span>💵 ${{ number_format($order->price, 2) }}</span>
                                    <span>📅 {{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                @if($order->status === 'pending')
                                    <a href="{{ route('orders.payment', $order) }}" class="btn btn-primary" style="margin-top: 15px; display: inline-block; text-decoration: none;">Complete Payment</a>
                                @endif
                            </li>
                        @empty
                            <div class="empty-state">
                                <div class="empty-state-icon">📋</div>
                                <p>No orders yet. Start by finding a freelancer!</p>
                                <a href="{{ route('find-freelancers') }}" class="btn btn-primary" style="margin-top: 15px; display: inline-block; text-decoration: none;">Browse Freelancers</a>
                            </div>
                        @endforelse
                    </ul>
                    @if($user->clientOrders()->count() > 0)
                        <a href="{{ route('orders.index') }}" class="view-all-link">View All Orders →</a>
                    @endif
                </div>

                <div class="card">
                    <h2>💡 Quick Actions</h2>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <a href="{{ route('find-freelancers') }}" class="btn btn-primary" style="text-decoration: none; text-align: center;">
                            🔍 Find Freelancers
                        </a>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary" style="text-decoration: none; text-align: center; background: linear-gradient(135deg, #4CAF50, #45a049);">
                            ➕ Create Order
                        </a>
                        <a href="{{ route('chat.index') }}" class="btn btn-primary" style="text-decoration: none; text-align: center; background: linear-gradient(135deg, #667eea, #764ba2);">
                            💬 Messages
                        </a>
                    </div>

                    <div style="margin-top: 30px; padding: 20px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); border-radius: 12px;">
                        <h3 style="font-size: 16px; margin-bottom: 10px;">💼 Need Help?</h3>
                        <p style="font-size: 13px; color: #666; line-height: 1.6;">
                            Browse our talented freelancers or post a job to get started. Our platform makes it easy to find and hire the perfect professional for your project.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
