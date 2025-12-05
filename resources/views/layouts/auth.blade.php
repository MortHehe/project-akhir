<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - WORKZY</title>
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
            position: fixed;
            height: 100vh;
            overflow-y: auto;
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
            margin-left: 280px;
            padding: 40px 50px;
            overflow-y: auto;
            min-height: 100vh;
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

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .page-header > * {
            position: relative;
            z-index: 1;
        }

        .page-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .page-header p {
            font-size: 16px;
            opacity: 0.95;
        }

        /* Cards */
        .card {
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            border: 2px solid #f0f0f0;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }

        .card h2 {
            margin-bottom: 25px;
            color: #1a1a1a;
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 2px solid #b1dfbb;
        }

        .alert-error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 2px solid #f1b0b7;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border: 2px solid #ffe89a;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border: 2px solid #abdde5;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            display: inline-block;
            text-decoration: none;
            text-align: center;
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

        .btn-secondary {
            background: #f0f0f0;
            color: #666;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }

            .main-content {
                margin-left: 250px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Stat Cards - Universal for all freelancer pages */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            width: 100%;
        }

        .stats-grid.five-column {
            grid-template-columns: repeat(5, 1fr);
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            width: 100%;
        }

        .stat-card {
            background: white;
            padding: 25px 20px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid #f5f5f5;
            text-align: center;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .stat-card .icon,
        .stat-card span.icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }

        .stat-card h3,
        .stat-card .label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .stat-card .number,
        .stat-card .value {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .stat-card .change,
        .stat-card .subtitle {
            font-size: 12px;
            color: #666;
            font-weight: 600;
        }

        @media (max-width: 1400px) {
            .stat-card .number,
            .stat-card .value {
                font-size: 28px;
            }
            .stat-card .icon,
            .stat-card span.icon {
                font-size: 36px;
            }
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .stats-row {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid,
            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        @yield('additional-styles')
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>⚫ WORKZY</h2>
            </div>

            <nav class="menu">
                @if(auth()->user()->isFreelancer())
                    <div class="menu-section">
                        <div class="menu-label">Menu</div>
                        <a href="{{ route('freelancer.dashboard') }}" class="menu-item @yield('menu-dashboard')">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('freelancer.index') }}" class="menu-item @yield('menu-orders')">
                            <span>📂</span> My Orders
                        </a>
                        <a href="{{ route('chat.index') }}" class="menu-item @yield('menu-messages')">
                            <span>💬</span> Messages
                            @php
                                $unreadCount = App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="notification-badge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('reviews.index') }}" class="menu-item @yield('menu-reviews')">
                            <span>⭐</span> Reviews
                        </a>
                    </div>

                    <div class="menu-section">
                        <div class="menu-label">Account</div>
                        <a href="{{ route('freelancer.myprofile') }}" class="menu-item @yield('menu-profile')">
                            <span>👤</span> Profile
                        </a>
                        <a href="{{ route('freelancer.earnings') }}" class="menu-item @yield('menu-earnings')">
                            <span>💰</span> Earnings
                        </a>
                        <a href="{{ route('freelancer.settings') }}" class="menu-item @yield('menu-settings')">
                            <span>⚙️</span> Settings
                        </a>
                    </div>
                @else
                    <div class="menu-section">
                        <div class="menu-label">Menu</div>
                        <a href="{{ route('user.dashboard') }}" class="menu-item @yield('menu-dashboard')">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('orders.index') }}" class="menu-item @yield('menu-orders')">
                            <span>📂</span> My Orders
                        </a>
                        <a href="{{ route('find-freelancers') }}" class="menu-item @yield('menu-find')">
                            <span>🔍</span> Find Freelancers
                        </a>
                        <a href="{{ route('chat.index') }}" class="menu-item @yield('menu-messages')">
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
                        <a href="{{ route('user.profile') }}" class="menu-item @yield('menu-profile')">
                            <span>👤</span> Profile
                        </a>
                        <a href="{{ route('user.payments') }}" class="menu-item @yield('menu-payments')">
                            <span>💰</span> Payments
                        </a>
                        <a href="{{ route('user.settings') }}" class="menu-item @yield('menu-settings')">
                            <span>⚙️</span> Settings
                        </a>
                    </div>
                @endif
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
                    <span class="badge">{{ auth()->user()->isFreelancer() ? 'Freelancer' : 'Client' }}</span>
                    <span style="opacity: 0.5;">▼</span>

                    <div class="dropdown-menu">
                        <a href="{{ auth()->user()->isFreelancer() ? route('freelancer.dashboard') : route('user.dashboard') }}" class="dropdown-item">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ auth()->user()->isFreelancer() ? route('freelancer.myprofile') : route('user.profile') }}" class="dropdown-item">
                            <span>👤</span> My Profile
                        </a>
                        <a href="{{ auth()->user()->isFreelancer() ? route('freelancer.settings') : route('user.settings') }}" class="dropdown-item">
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

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
