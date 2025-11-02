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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .filters {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .filter-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .filter-item label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .filter-item select,
        .filter-item input {
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .orders-grid {
            display: grid;
            gap: 20px;
        }
        
        .order-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: 1px solid transparent;
        }
        
        .order-card:hover {
            border-color: #667eea;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }
        
        .order-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .client-name {
            color: #666;
            font-size: 14px;
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
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-delivered { background: #e7e3ff; color: #4a47a3; }
        
        .order-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .order-meta {
            display: flex;
            gap: 30px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            margin-bottom: 20px;
        }
        
        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .meta-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
        }
        
        .meta-value {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        
        .order-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
        }
        
        .btn-success {
            background: #4CAF50;
            color: white;
        }
        
        .btn-success:hover {
            background: #45a049;
        }
        
        .btn-outline {
            background: white;
            border: 1px solid #667eea;
            color: #667eea;
        }
        
        .btn-outline:hover {
            background: #667eea;
            color: white;
        }
        
        .btn-danger {
            background: white;
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }
        
        .btn-danger:hover {
            background: #e74c3c;
            color: white;
        }
        
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 4px;
            overflow: hidden;
            margin: 15px 0;
        }
        
        .progress-fill {
            height: 100%;
            background: #4CAF50;
            border-radius: 4px;
            transition: width 0.3s;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .empty-state h3 {
            color: #999;
            margin-bottom: 10px;
        }
        
        .deadline-warning {
            background: #fff3cd;
            color: #856404;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .filters {
                flex-direction: column;
                align-items: stretch;
            }
            
            .stats-row {
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
                    <a href="{{ route('freelancer.dashboard') }}" class="menu-item">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('orders.index') }}" class="menu-item active">
                        <span>📦</span> My Orders
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
                <div>
                    <h1>My Orders 📦</h1>
                    <p>Manage your client orders and deliveries</p>
                </div>
            </div>
            
            @php
                $user = auth()->user();
                $pendingOrders = $user->freelancerOrders()->where('status', 'pending')->count();
                $activeOrders = $user->freelancerOrders()->whereIn('status', ['accepted', 'in_progress'])->count();
                $completedOrders = $user->freelancerOrders()->where('status', 'completed')->count();
                $totalEarnings = $user->freelancerOrders()->where('status', 'completed')->sum('price');
                $thisMonthEarnings = $user->freelancerOrders()
                    ->where('status', 'completed')
                    ->whereMonth('created_at', date('m'))
                    ->sum('price');
            @endphp
            
            <div class="stats-row">
                <div class="stat-card">
                    <h3>Pending Orders</h3>
                    <div class="number">{{ $pendingOrders }}</div>
                </div>
                <div class="stat-card">
                    <h3>Active Orders</h3>
                    <div class="number">{{ $activeOrders }}</div>
                </div>
                <div class="stat-card">
                    <h3>Completed</h3>
                    <div class="number">{{ $completedOrders }}</div>
                </div>
                <div class="stat-card">
                    <h3>This Month</h3>
                    <div class="number">IDR {{ number_format($thisMonthEarnings, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card">
                    <h3>Total Earnings</h3>
                    <div class="number">IDR {{ number_format($totalEarnings, 0, ',', '.') }}</div>
                </div>
            </div>
            
            <div class="filters">
                <div class="filter-item">
                    <label>Status</label>
                    <select onchange="filterOrders(this.value)">
                        <option value="all">All Orders</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="in_progress">In Progress</option>
                        <option value="delivered">Delivered</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label>Sort By</label>
                    <select>
                        <option>Latest First</option>
                        <option>Oldest First</option>
                        <option>Price High to Low</option>
                        <option>Price Low to High</option>
                        <option>Deadline Soon</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label>Search</label>
                    <input type="text" placeholder="Search orders...">
                </div>
            </div>
            
            @php
                $orders = $user->freelancerOrders()->with('user')->latest()->get();
            @endphp
            
            <div class="orders-grid">
                @forelse($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-title">{{ $order->job_title }}</div>
                                <div class="client-name">Client: {{ $order->user->name }}</div>
                            </div>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        
                        <div class="order-description">
                            {{ $order->job_description }}
                        </div>
                        
                        @if($order->status == 'in_progress')
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $order->progress ?? 30 }}%"></div>
                            </div>
                            <div style="text-align: center; color: #666; font-size: 14px;">
                                Progress: {{ $order->progress ?? 30 }}%
                            </div>
                        @endif
                        
                        @if($order->deadline && $order->status == 'in_progress')
                            @php
                                $daysLeft = now()->diffInDays($order->deadline, false);
                            @endphp
                            @if($daysLeft <= 3 && $daysLeft >= 0)
                                <div class="deadline-warning">
                                    ⚠️ Deadline in {{ $daysLeft }} days - {{ $order->deadline->format('M d, Y') }}
                                </div>
                            @endif
                        @endif
                        
                        <div class="order-meta">
                            <div class="meta-item">
                                <span class="meta-label">Budget</span>
                                <span class="meta-value">IDR {{ number_format($order->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Delivery</span>
                                <span class="meta-value">{{ $order->delivery_days ?? 7 }} days</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Order Date</span>
                                <span class="meta-value">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            @if($order->deadline)
                                <div class="meta-item">
                                    <span class="meta-label">Deadline</span>
                                    <span class="meta-value">{{ $order->deadline->format('M d, Y') }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="order-actions">
                            @if($order->status == 'pending')
                                <button class="btn btn-success" onclick="acceptOrder({{ $order->id }})">
                                    Accept Order
                                </button>
                                <button class="btn btn-danger" onclick="rejectOrder({{ $order->id }})">
                                    Reject
                                </button>
                                <button class="btn btn-outline" onclick="window.location.href='/orders/{{ $order->id }}'">
                                    View Details
                                </button>
                            @elseif($order->status == 'accepted' || $order->status == 'in_progress')
                                <button class="btn btn-primary" onclick="window.location.href='/orders/{{ $order->id }}/deliver'">
                                    Deliver Work
                                </button>
                                <button class="btn btn-outline" onclick="window.location.href='/messages/order/{{ $order->id }}'">
                                    Message Client
                                </button>
                                <button class="btn btn-outline" onclick="window.location.href='/orders/{{ $order->id }}'">
                                    View Details
                                </button>
                            @elseif($order->status == 'delivered')
                                <button class="btn btn-success" disabled>
                                    ✓ Delivered - Awaiting Review
                                </button>
                                <button class="btn btn-outline" onclick="window.location.href='/orders/{{ $order->id }}'">
                                    View Details
                                </button>
                            @elseif($order->status == 'completed')
                                <button class="btn btn-outline" onclick="window.location.href='/orders/{{ $order->id }}'">
                                    View Details
                                </button>
                                @if($order->review)
                                    <button class="btn btn-outline" onclick="window.location.href='/reviews/{{ $order->review->id }}'">
                                        View Review
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <h3>📦 No orders yet</h3>
                        <p style="color: #666; margin-bottom: 20px;">Orders from clients will appear here</p>
                        <button class="btn btn-primary" onclick="window.location.href='/browse-jobs'">
                            Browse Available Jobs
                        </button>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
    
    <script>
        function filterOrders(status) {
            console.log('Filtering by status:', status);
            // Add your filter logic here
        }
        
        function acceptOrder(orderId) {
            if(confirm('Are you sure you want to accept this order?')) {
                window.location.href = '/orders/' + orderId + '/accept';
            }
        }
        
        function rejectOrder(orderId) {
            if(confirm('Are you sure you want to reject this order?')) {
                window.location.href = '/orders/' + orderId + '/reject';
            }
        }
    </script>
</body>
</html>