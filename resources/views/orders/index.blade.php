@extends('layouts.auth')

@section('title', 'My Orders')
@section('menu-orders', 'active')

@section('additional-styles')
<style>
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
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .order-card {
        background: white;
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 2px solid #f5f5f5;
    }

    .order-card:hover {
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        transform: translateY(-3px);
        border-color: #667eea;
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
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .order-id {
        font-size: 13px;
        color: #999;
        font-weight: 600;
    }

    .order-status {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe89a 100%);
        color: #856404;
    }

    .status-paid {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
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

    .status-cancelled, .status-rejected {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c2c7 100%);
        color: #721c24;
    }

    .order-body {
        margin-bottom: 15px;
    }

    .order-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .order-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 15px;
        padding: 15px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 10px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
        font-weight: 600;
    }

    .meta-icon {
        font-size: 16px;
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 2px solid #f0f0f0;
    }

    .order-price {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .order-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
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
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }

    .btn-secondary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .empty-state-icon {
        font-size: 72px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .empty-state p {
        font-size: 16px;
        color: #666;
        margin-bottom: 25px;
        line-height: 1.6;
    }

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
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        color: #666;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        min-width: 40px;
        text-align: center;
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

    .pagination .disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .order-header {
            flex-direction: column;
            gap: 10px;
        }

        .order-footer {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .order-actions {
            width: 100%;
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }

        .orders-header {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .btn-create {
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>📦 My Orders</h1>
        <p>Manage and track all your project orders</p>
    </div>

    <div class="orders-header">
        <h2 style="font-size: 20px; font-weight: 700;">
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
@endsection
