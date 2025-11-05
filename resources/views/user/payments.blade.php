<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - WORKZY</title>
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
        
        /* Sidebar - Same as settings */
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
            background: #2196F3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
        
        .badge {
            background: #2196F3;
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
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
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
        
        /* Stats Grid */
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
        
        .stat-card .icon {
            font-size: 32px;
            margin-bottom: 15px;
        }
        
        .stat-card .label {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .stat-card .value {
            font-size: 32px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .stat-card .change {
            font-size: 13px;
            color: #2196F3;
        }
        
        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            padding: 25px 30px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h2 {
            font-size: 18px;
            color: #1a1a1a;
        }
        
        .filter-select {
            padding: 8px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }
        
        .card-body {
            padding: 30px;
        }
        
        /* Transaction Item */
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        
        .transaction-item:hover {
            border-color: #2196F3;
            box-shadow: 0 2px 10px rgba(33, 150, 243, 0.1);
        }
        
        .transaction-left {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .transaction-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            background: #e3f2fd;
        }
        
        .transaction-info h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }
        
        .transaction-info p {
            font-size: 13px;
            color: #666;
        }
        
        .transaction-amount {
            text-align: right;
        }
        
        .transaction-amount .amount {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #e74c3c;
        }
        
        .transaction-amount .status {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 12px;
            display: inline-block;
        }
        
        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-failed {
            background: #f8d7da;
            color: #842029;
        }
        
        /* Payment Methods */
        .payment-method {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .payment-method-left {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .payment-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        
        .payment-info h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }
        
        .payment-info p {
            font-size: 13px;
            color: #666;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #2196F3;
            color: white;
        }
        
        .btn-primary:hover {
            background: #1976D2;
        }
        
        .btn-outline {
            background: transparent;
            color: #2196F3;
            border: 2px solid #2196F3;
        }
        
        .btn-outline:hover {
            background: #e3f2fd;
        }
        
        .btn-danger {
            background: transparent;
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }
        
        .btn-danger:hover {
            background: #fee;
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
            margin-bottom: 20px;
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
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .transaction-item {
                flex-direction: column;
                gap: 15px;
            }
            
            .transaction-amount {
                text-align: left;
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
                    <a href="{{ route('user.dashboard') }}" class="menu-item">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('user.projects') }}" class="menu-item">
                        <span>📂</span> My Projects
                    </a>
                    <a href="{{ route('user.find-freelancers') }}" class="menu-item">
                        <span>🔍</span> Find Freelancers
                    </a>
                </div>
                
                <div class="menu-section">
                    <div class="menu-label">Others</div>
                    <a href="{{ route('user.settings') }}" class="menu-item">
                        <span>⚙️</span> Settings
                    </a>
                    <a href="{{ route('user.payments') }}" class="menu-item active">
                        <span>💳</span> Payments
                    </a>
                    <a href="{{ route('user.profile') }}" class="menu-item">
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
                    <span class="badge">Client</span>
                    <span>▼</span>
                    
                    <div class="dropdown-menu">
                        <a href="{{ route('user.dashboard') }}" class="dropdown-item">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('user.profile') }}" class="dropdown-item">
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
                <h1>💳 Payments</h1>
                <p>Manage your payments and transaction history</p>
            </div>
            
            @php
                $user = auth()->user();
                $totalSpent = $user->clientOrders()->where('status', 'completed')->sum('price') ?? 0;
                $pendingPayments = $user->clientOrders()->whereIn('status', ['pending', 'in_progress'])->sum('price') ?? 0;
                $thisMonth = $user->clientOrders()
                    ->where('status', 'completed')
                    ->whereMonth('updated_at', now()->month)
                    ->sum('price') ?? 0;
                $completedProjects = $user->clientOrders()->where('status', 'completed')->count();
            @endphp
            
            <!-- Payment Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon">💵</div>
                    <div class="label">Total Spent</div>
                    <div class="value">IDR {{ number_format($totalSpent, 0, ',', '.') }}</div>
                    <div class="change">📊 All time</div>
                </div>
                
                <div class="stat-card">
                    <div class="icon">⏳</div>
                    <div class="label">Pending Payments</div>
                    <div class="value">IDR {{ number_format($pendingPayments, 0, ',', '.') }}</div>
                    <div class="change">🔄 Active projects</div>
                </div>
                
                <div class="stat-card">
                    <div class="icon">📅</div>
                    <div class="label">This Month</div>
                    <div class="value">IDR {{ number_format($thisMonth, 0, ',', '.') }}</div>
                    <div class="change">{{ now()->format('F Y') }}</div>
                </div>
                
                <div class="stat-card">
                    <div class="icon">✅</div>
                    <div class="label">Completed Projects</div>
                    <div class="value">{{ $completedProjects }}</div>
                    <div class="change">Total projects</div>
                </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="card">
                <div class="card-header">
                    <h2>💳 Payment Methods</h2>
                    <button class="btn btn-primary">Add New Method</button>
                </div>
                <div class="card-body">
                    <!-- Sample Payment Method -->
                    <div class="payment-method">
                        <div class="payment-method-left">
                            <div class="payment-icon">💳</div>
                            <div class="payment-info">
                                <h3>Visa •••• 4242</h3>
                                <p>Expires 12/2025</p>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-outline">Set as Default</button>
                            <button class="btn btn-danger" style="margin-left: 10px;">Remove</button>
                        </div>
                    </div>
                    
                    <div class="payment-method">
                        <div class="payment-method-left">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-info">
                                <h3>Bank Transfer - BCA</h3>
                                <p>Account •••• 5678</p>
                            </div>
                        </div>
                        <div>
                            <span class="status-completed" style="margin-right: 10px;">Default</span>
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Transaction History -->
            <div class="card">
                <div class="card-header">
                    <h2>💼 Payment History</h2>
                    <select class="filter-select">
                        <option value="all">All Time</option>
                        <option value="month">This Month</option>
                        <option value="week">This Week</option>
                        <option value="today">Today</option>
                    </select>
                </div>
                <div class="card-body">
                    @php
                        $transactions = $user->clientOrders()
                            ->whereIn('status', ['completed', 'in_progress'])
                            ->with('freelancer')
                            ->latest()
                            ->take(10)
                            ->get();
                    @endphp
                    
                    @forelse($transactions as $transaction)
                        <div class="transaction-item">
                            <div class="transaction-left">
                                <div class="transaction-icon">💸</div>
                                <div class="transaction-info">
                                    <h3>{{ $transaction->job_title }}</h3>
                                    <p>To {{ $transaction->freelancer->name }} • {{ $transaction->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="transaction-amount">
                                <div class="amount">-IDR {{ number_format($transaction->price, 0, ',', '.') }}</div>
                                <span class="status status-{{ $transaction->status === 'completed' ? 'completed' : 'pending' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="icon">💳</div>
                            <h3>No Payments Yet</h3>
                            <p>Your payment history will appear here once you start hiring freelancers</p>
                            <button class="btn btn-primary">Find Freelancers</button>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Invoices -->
            <div class="card">
                <div class="card-header">
                    <h2>📄 Invoices</h2>
                </div>
                <div class="card-body">
                    <div class="empty-state">
                        <div class="icon">📄</div>
                        <h3>No Invoices</h3>
                        <p>Your invoices will be available here for download</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
