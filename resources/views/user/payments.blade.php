@extends('layouts.auth')

@section('title', 'Payments')
@section('menu-payments', 'active')

@section('additional-styles')
<style>
    .payment-card {
        background: white;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        transition: all 0.3s;
        border-left: 4px solid transparent;
    }

    .payment-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.15);
        border-left-color: #667eea;
    }

    .payment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .payment-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .payment-amount {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .payment-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        font-size: 14px;
        color: #666;
        margin-top: 10px;
    }

    .payment-meta span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-completed {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }

    .status-pending {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
    }

    .status-failed {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-box {
        background: white;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.15);
    }

    .stat-label {
        font-size: 13px;
        color: #999;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state-icon {
        font-size: 72px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 25px;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>💰 Payments</h1>
        <p>View your payment history and transactions</p>
    </div>

    @php
        $user = auth()->user();
        $completedOrders = $user->clientOrders()->where('status', 'completed')->get();
        $paidOrders = $user->clientOrders()->whereIn('status', ['paid', 'accepted', 'in_progress', 'completed'])->get();
        $pendingOrders = $user->clientOrders()->where('status', 'pending')->get();

        $totalPaid = $paidOrders->sum('price');
        $totalSpent = $completedOrders->sum('price');
        $pendingAmount = $pendingOrders->sum('price');
    @endphp

    <!-- Payment Stats -->
    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-label">Total Spent</div>
            <div class="stat-value">${{ number_format($totalSpent, 2) }}</div>
            <p style="color: #666; font-size: 13px; margin-top: 8px;">✅ Completed projects</p>
        </div>

        <div class="stat-box">
            <div class="stat-label">Total Paid</div>
            <div class="stat-value">${{ number_format($totalPaid, 2) }}</div>
            <p style="color: #666; font-size: 13px; margin-top: 8px;">💳 All paid orders</p>
        </div>

        <div class="stat-box">
            <div class="stat-label">Pending Payment</div>
            <div class="stat-value">${{ number_format($pendingAmount, 2) }}</div>
            <p style="color: #666; font-size: 13px; margin-top: 8px;">⏳ Awaiting payment</p>
        </div>

        <div class="stat-box">
            <div class="stat-label">Total Transactions</div>
            <div class="stat-value">{{ $paidOrders->count() }}</div>
            <p style="color: #666; font-size: 13px; margin-top: 8px;">📊 Payment count</p>
        </div>
    </div>

    <!-- Payment History -->
    <div class="card">
        <h2>📜 Payment History</h2>
        <p style="color: #666; margin-bottom: 25px;">All your payment transactions</p>

        @if($paidOrders->count() > 0)
            @foreach($paidOrders as $order)
                <div class="payment-card">
                    <div class="payment-header">
                        <div>
                            <div class="payment-title">{{ $order->job_title }}</div>
                            <div style="color: #999; font-size: 13px; margin-top: 5px;">
                                Order #{{ $order->id }}
                                @if($order->freelancer)
                                    • Freelancer: {{ $order->freelancer->name }}
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="payment-amount">${{ number_format($order->price, 2) }}</div>
                            <span class="status-badge status-{{ $order->status === 'completed' ? 'completed' : 'pending' }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                    </div>

                    <div class="payment-meta">
                        <span>📅 Paid: {{ $order->paid_at ? $order->paid_at->format('M d, Y') : 'Pending' }}</span>
                        @if($order->payment_method)
                            <span>💳 Method: {{ ucfirst($order->payment_method) }}</span>
                        @endif
                        @if($order->deadline)
                            <span>⏰ Deadline: {{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}</span>
                        @endif
                        <span>🕒 Created: {{ $order->created_at->format('M d, Y') }}</span>
                    </div>

                    <div style="margin-top: 15px; display: flex; gap: 10px;">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px;">View Order</a>
                        @if($order->freelancer)
                            <a href="{{ route('chat.show', $order->freelancer_id) }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px;">💬 Message</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-state-icon">💳</div>
                <h3>No Payment History</h3>
                <p>You haven't made any payments yet. Create an order to get started!</p>
                <a href="{{ route('orders.create') }}" class="btn btn-primary">➕ Create Your First Order</a>
            </div>
        @endif
    </div>

    @if($pendingOrders->count() > 0)
        <!-- Pending Payments -->
        <div class="card" style="border: 2px solid #fff3cd;">
            <h2>⏳ Pending Payments</h2>
            <p style="color: #666; margin-bottom: 25px;">Orders awaiting payment</p>

            @foreach($pendingOrders as $order)
                <div class="payment-card" style="background: #fffef5;">
                    <div class="payment-header">
                        <div>
                            <div class="payment-title">{{ $order->job_title }}</div>
                            <div style="color: #999; font-size: 13px; margin-top: 5px;">Order #{{ $order->id }}</div>
                        </div>
                        <div>
                            <div class="payment-amount">${{ number_format($order->price, 2) }}</div>
                            <span class="status-badge status-pending">Pending Payment</span>
                        </div>
                    </div>

                    <div class="payment-meta">
                        <span>📅 Created: {{ $order->created_at->format('M d, Y H:i') }}</span>
                        @if($order->deadline)
                            <span>⏰ Deadline: {{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}</span>
                        @endif
                    </div>

                    <div style="margin-top: 15px;">
                        <a href="{{ route('orders.payment', $order) }}" class="btn btn-primary" style="padding: 10px 20px;">💳 Complete Payment Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
