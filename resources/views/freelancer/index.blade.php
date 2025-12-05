@extends('layouts.auth')

@section('title', 'My Orders')
@section('menu-orders', 'active')

@section('additional-styles')
<style>
    .filters {
        background: white;
        padding: 20px 28px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        display: flex;
        align-items: flex-end;
        gap: 20px;
        border: 2px solid #f5f5f5;
        flex-wrap: wrap;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 200px;
    }

    .filter-item.search-item {
        flex: 1;
        min-width: 250px;
    }

    .filter-item label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
        white-space: nowrap;
    }

    .filter-item select,
    .filter-item input {
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: inherit;
        background: white;
        font-weight: 600;
    }

    .filter-item select:focus,
    .filter-item input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .filter-item input::placeholder {
        color: #999;
        font-weight: 500;
    }

    .orders-grid {
        display: grid;
        gap: 25px;
    }

    .order-card {
        background: white;
        padding: 28px;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 2px solid #f5f5f5;
        position: relative;
        overflow: hidden;
    }

    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-5px);
        border-color: #667eea;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.2);
    }

    .order-card:hover::before {
        opacity: 1;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
    }

    .order-title {
        font-size: 20px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .client-name {
        color: #666;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .client-name::before {
        content: '👤';
        font-size: 14px;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .status-pending {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe89a 100%);
        color: #856404;
    }
    .status-accepted {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
    }
    .status-in_progress {
        background: linear-gradient(135deg, #cfe2ff 0%, #b6d4fe 100%);
        color: #084298;
    }
    .status-completed {
        background: linear-gradient(135deg, #d1e7dd 0%, #badbcc 100%);
        color: #0f5132;
    }
    .status-cancelled {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c2c7 100%);
        color: #721c24;
    }
    .status-delivered {
        background: linear-gradient(135deg, #e7e3ff 0%, #d4cdff 100%);
        color: #4a47a3;
    }
    .status-paid {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .order-description {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .order-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 20px;
        padding: 20px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
        text-align: center;
    }

    .meta-label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .meta-value {
        font-size: 16px;
        font-weight: 800;
        color: #667eea;
    }

    .order-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
    }

    .btn-outline {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
    }

    .btn-outline:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: white;
        border: 2px solid #e74c3c;
        color: #e74c3c;
    }

    .btn-danger:hover {
        background: #e74c3c;
        color: white;
        transform: translateY(-2px);
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .btn:disabled:hover {
        transform: none;
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

    @media (max-width: 1024px) {
        .filters {
            gap: 15px;
            padding: 18px 24px;
        }

        .filter-item {
            min-width: 180px;
        }
    }

    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
            padding: 20px;
        }

        .filter-item,
        .filter-item.search-item {
            width: 100%;
            min-width: 100%;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .order-meta {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>📦 My Orders</h1>
        <p>Manage your client orders and deliveries</p>
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
            <span class="icon">⏳</span>
            <div class="label">Pending Orders</div>
            <div class="value">{{ $pendingOrders }}</div>
            <div class="subtitle">Awaiting response</div>
        </div>
        <div class="stat-card">
            <span class="icon">🔥</span>
            <div class="label">Active Orders</div>
            <div class="value">{{ $activeOrders }}</div>
            <div class="subtitle">In progress</div>
        </div>
        <div class="stat-card">
            <span class="icon">✅</span>
            <div class="label">Completed</div>
            <div class="value">{{ $completedOrders }}</div>
            <div class="subtitle">Total completed</div>
        </div>
        <div class="stat-card">
            <span class="icon">📅</span>
            <div class="label">This Month</div>
            <div class="value">IDR {{ number_format($thisMonthEarnings, 0, ',', '.') }}</div>
            <div class="subtitle">{{ date('F Y') }}</div>
        </div>
        <div class="stat-card">
            <span class="icon">💰</span>
            <div class="label">Total Earnings</div>
            <div class="value">IDR {{ number_format($totalEarnings, 0, ',', '.') }}</div>
            <div class="subtitle">All time earnings</div>
        </div>
    </div>

    <div class="filters">
        <div class="filter-item">
            <label>Filter by Status</label>
            <select id="statusFilter" onchange="filterOrders(this.value)">
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
            <select id="sortFilter">
                <option>Latest First</option>
                <option>Oldest First</option>
                <option>Price High to Low</option>
                <option>Price Low to High</option>
                <option>Deadline Soon</option>
            </select>
        </div>
        <div class="filter-item search-item">
            <label>Search</label>
            <input type="text" id="searchInput" placeholder="Search orders...">
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
@endsection

@section('scripts')
<script>
    function filterOrders(status) {
        console.log('Filtering by status:', status);
        // Add your filter logic here
        // You can implement AJAX call or page reload with query parameter
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
@endsection
