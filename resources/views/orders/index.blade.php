<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - WORKZY</title>
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

        /* Navigation */
        nav {
            background: white;
            padding: 20px 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links a {
            margin-left: 30px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 60px 40px;
            color: white;
        }

        .page-header h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 18px;
            opacity: 0.95;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 40px auto 60px;
            padding: 0 60px;
        }

        /* Orders List */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-create {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .order-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }

        .order-card:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .order-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .order-id {
            font-size: 14px;
            color: #999;
        }

        .order-status {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-paid {
            background: #d4edda;
            color: #155724;
        }

        .status-accepted {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-in_progress {
            background: #cce5ff;
            color: #004085;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled, .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .order-body {
            margin-bottom: 15px;
        }

        .order-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .order-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #666;
        }

        .meta-icon {
            font-size: 16px;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .order-price {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
        }

        .order-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 12px;
        }

        .empty-state-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: white;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            color: #666;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .pagination a:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .pagination .active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 60px;
            margin-top: 60px;
            text-align: center;
        }

        footer p {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .order-header {
                flex-direction: column;
            }

            .order-footer {
                flex-direction: column;
                gap: 15px;
            }

            .order-actions {
                width: 100%;
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">WORKZY</div>
        <div class="nav-links">
            <a href="{{ route('welcome') }}">Home</a>
            @auth
                @if(auth()->user()->isFreelancer())
                    <a href="{{ route('freelancer.dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                @endif
                <a href="{{ route('chat.index') }}">Messages</a>
            @endauth
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>My Orders</h1>
        <p>Manage and track all your project orders</p>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="orders-header">
            <h2>
                @if(auth()->user()->isFreelancer())
                    Orders Assigned to You
                @else
                    Your Orders
                @endif
            </h2>
            @if(!auth()->user()->isFreelancer())
                <a href="{{ route('orders.create') }}" class="btn-create">+ Create New Order</a>
            @endif
        </div>

        @if($orders->count() > 0)
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-title">{{ $order->job_title }}</div>
                            <div class="order-id">Order #{{ $order->id }}</div>
                        </div>
                        <span class="order-status status-{{ $order->status }}">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>

                    <div class="order-body">
                        <div class="order-description">
                            {{ Str::limit($order->job_description, 200) }}
                        </div>

                        <div class="order-meta">
                            @if($order->deadline)
                                <div class="meta-item">
                                    <span class="meta-icon">📅</span>
                                    <span>Deadline: {{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}</span>
                                </div>
                            @endif

                            @if(auth()->user()->isFreelancer())
                                <div class="meta-item">
                                    <span class="meta-icon">👤</span>
                                    <span>Client: {{ $order->user->name }}</span>
                                </div>
                            @else
                                @if($order->freelancer)
                                    <div class="meta-item">
                                        <span class="meta-icon">👤</span>
                                        <span>Freelancer: {{ $order->freelancer->name }}</span>
                                    </div>
                                @else
                                    <div class="meta-item">
                                        <span class="meta-icon">👥</span>
                                        <span>Open to all freelancers</span>
                                    </div>
                                @endif
                            @endif

                            <div class="meta-item">
                                <span class="meta-icon">🕒</span>
                                <span>Created {{ $order->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-price">${{ number_format($order->price, 2) }}</div>

                        <div class="order-actions">
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">View Details</a>

                            @if($order->status === 'pending' && !auth()->user()->isFreelancer())
                                <a href="{{ route('orders.payment', $order) }}" class="btn btn-secondary">Complete Payment</a>
                            @endif

                            @if(($order->freelancer && auth()->user()->isFreelancer() && $order->freelancer_id === auth()->id()) ||
                                (!auth()->user()->isFreelancer() && $order->freelancer))
                                <a href="{{ route('chat.show', auth()->user()->isFreelancer() ? $order->user_id : $order->freelancer_id) }}" class="btn btn-secondary">
                                    💬 Message
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="pagination">
                    @if ($orders->onFirstPage())
                        <span class="disabled">« Previous</span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}">« Previous</a>
                    @endif

                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                        @if ($page == $orders->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}">Next »</a>
                    @else
                        <span class="disabled">Next »</span>
                    @endif
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <h3>No Orders Yet</h3>
                <p>
                    @if(auth()->user()->isFreelancer())
                        You don't have any orders assigned to you yet. Keep your profile updated and wait for clients to reach out!
                    @else
                        You haven't created any orders yet. Start by finding a freelancer and creating your first order.
                    @endif
                </p>
                @if(!auth()->user()->isFreelancer())
                    <a href="{{ route('orders.create') }}" class="btn-create">Create Your First Order</a>
                @endif
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 WORKZY. All rights reserved.</p>
    </footer>
</body>
</html>
