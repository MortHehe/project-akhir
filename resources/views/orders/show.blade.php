<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - WORKZY</title>
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
            margin: -40px auto 60px;
            padding: 0 60px;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* Order Container */
        .order-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .order-details-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 40px;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 150px 1fr;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            color: #333;
        }

        .description-text {
            line-height: 1.8;
            white-space: pre-wrap;
        }

        /* Status Badge */
        .status-badge {
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

        /* Order Summary Card */
        .order-summary-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
        }

        .summary-value {
            color: #333;
            font-weight: 600;
        }

        .summary-total {
            border-top: 2px solid #f0f0f0;
            margin-top: 15px;
            padding-top: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
        }

        /* Action Buttons */
        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
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

        @media (max-width: 968px) {
            .order-container {
                grid-template-columns: 1fr;
            }

            .order-summary-card {
                position: static;
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
                <a href="{{ route('orders.index') }}">My Orders</a>
            @endauth
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Order #{{ $order->id }}</h1>
        <p>{{ $order->job_title }}</p>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="order-container">
            <!-- Order Details -->
            <div class="order-details-card">
                <div class="card-title">Order Details</div>

                <div class="detail-row">
                    <div class="detail-label">Order ID</div>
                    <div class="detail-value">#{{ $order->id }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <span class="status-badge status-{{ $order->status }}">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Project Title</div>
                    <div class="detail-value">{{ $order->job_title }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Description</div>
                    <div class="detail-value description-text">{{ $order->job_description ?? 'No description provided' }}</div>
                </div>

                @if($order->requirements)
                    <div class="detail-row">
                        <div class="detail-label">Requirements</div>
                        <div class="detail-value description-text">{{ $order->requirements }}</div>
                    </div>
                @endif

                <div class="detail-row">
                    <div class="detail-label">Budget</div>
                    <div class="detail-value">${{ number_format($order->price, 2) }}</div>
                </div>

                @if($order->deadline)
                    <div class="detail-row">
                        <div class="detail-label">Deadline</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}</div>
                    </div>
                @endif

                <div class="detail-row">
                    <div class="detail-label">Client</div>
                    <div class="detail-value">{{ $order->user->name }} ({{ $order->user->email }})</div>
                </div>

                @if($order->freelancer)
                    <div class="detail-row">
                        <div class="detail-label">Freelancer</div>
                        <div class="detail-value">{{ $order->freelancer->name }} ({{ $order->freelancer->email }})</div>
                    </div>
                @else
                    <div class="detail-row">
                        <div class="detail-label">Freelancer</div>
                        <div class="detail-value">Open to all freelancers</div>
                    </div>
                @endif

                @if($order->payment_method)
                    <div class="detail-row">
                        <div class="detail-label">Payment Method</div>
                        <div class="detail-value">{{ ucfirst($order->payment_method) }}</div>
                    </div>
                @endif

                @if($order->paid_at)
                    <div class="detail-row">
                        <div class="detail-label">Paid At</div>
                        <div class="detail-value">{{ $order->paid_at->format('M d, Y H:i A') }}</div>
                    </div>
                @endif

                <div class="detail-row">
                    <div class="detail-label">Created</div>
                    <div class="detail-value">{{ $order->created_at->format('M d, Y H:i A') }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Last Updated</div>
                    <div class="detail-value">{{ $order->updated_at->format('M d, Y H:i A') }}</div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary-card">
                <div class="summary-title">Payment Summary</div>

                <div class="summary-item">
                    <span class="summary-label">Project Cost</span>
                    <span class="summary-value">${{ number_format($order->price, 2) }}</span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Platform Fee (5%)</span>
                    <span class="summary-value">${{ number_format($order->price * 0.05, 2) }}</span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Processing Fee</span>
                    <span class="summary-value">${{ number_format($order->price * 0.029 + 0.30, 2) }}</span>
                </div>

                <div class="summary-item summary-total">
                    <span class="summary-label">Total Paid</span>
                    <span class="summary-value">${{ number_format($order->price * 1.079 + 0.30, 2) }}</span>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @if($order->status === 'pending')
                        <a href="{{ route('orders.payment', $order) }}" class="btn btn-primary">
                            Complete Payment
                        </a>
                    @endif

                    @if($order->freelancer)
                        <a href="{{ route('chat.show', $order->freelancer->id) }}" class="btn btn-secondary">
                            Message Freelancer
                        </a>
                    @endif

                    @if($order->status === 'paid' || $order->status === 'accepted')
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                            View All Orders
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 WORKZY. All rights reserved.</p>
    </footer>
</body>
</html>
