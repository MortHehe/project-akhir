@extends('layouts.auth')

@section('title', 'User Dashboard')
@section('menu-dashboard', 'active')

@section('additional-styles')
<style>
    .sections-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    .order-list {
        list-style: none;
    }

    .order-item {
        padding: 22px;
        border: 2px solid #f0f0f0;
        border-radius: 14px;
        margin-bottom: 16px;
        transition: all 0.3s ease;
        background: white;
    }

    .order-item:hover {
        border-color: #667eea;
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.12);
        transform: translateX(8px);
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.02) 0%, rgba(118, 75, 162, 0.02) 100%);
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

    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .help-box {
        margin-top: 30px;
        padding: 20px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border-radius: 12px;
    }

    .help-box h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .help-box p {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
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
</style>
@endsection

@section('content')
    <div class="page-header">
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
            <span class="icon">📊</span>
            <h3>Active Projects</h3>
            <div class="number">{{ $activeOrders }}</div>
            <div class="change">Currently in progress</div>
        </div>
        <div class="stat-card">
            <span class="icon">✅</span>
            <h3>Completed Projects</h3>
            <div class="number">{{ $completedOrders }}</div>
            <div class="change">Successfully delivered</div>
        </div>
        <div class="stat-card">
            <span class="icon">⏳</span>
            <h3>Pending Orders</h3>
            <div class="number">{{ $pendingOrders }}</div>
            <div class="change">Awaiting payment</div>
        </div>
        <div class="stat-card">
            <span class="icon">💰</span>
            <h3>Total Spent</h3>
            <div class="number">${{ number_format($totalSpent, 0) }}</div>
            <div class="change">Lifetime spending</div>
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
            <div class="quick-actions">
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

            <div class="help-box">
                <h3>💼 Need Help?</h3>
                <p>
                    Browse our talented freelancers or post a job to get started. Our platform makes it easy to find and hire the perfect professional for your project.
                </p>
            </div>
        </div>
    </div>
@endsection
