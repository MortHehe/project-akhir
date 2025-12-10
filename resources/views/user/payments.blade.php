@extends('layouts.auth')

@section('title', 'Payments')
@section('menu-payments', 'active')

@section('additional-styles')
<style>
    /* Transaction Item */
    .payment-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: none;
        position: relative;
        overflow: hidden;
    }

    .payment-card:hover {
        border-color: #667eea;
        background: #fafbfc;
    }

    .payment-header {
        display: flex;
        gap: 16px;
        align-items: center;
        flex: 1;
    }

    .payment-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: #f3f4f6;
        flex-shrink: 0;
    }

    .payment-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .payment-title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 4px;
        color: #1f2937;
        line-height: 1.2;
    }

    .payment-meta {
        font-size: 13px;
        color: #6b7280;
        font-weight: 400;
        line-height: 1.2;
    }

    .payment-right {
        text-align: right;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
    }

    .payment-amount {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #1f2937;
    }

    .payment-amount.negative {
        color: #dc2626;
    }

    .payment-amount.positive {
        color: #16a34a;
    }

    .status-badge {
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        text-transform: capitalize;
        letter-spacing: 0;
    }

    .filter-select {
        padding: 10px 18px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
    }

    .filter-select:focus {
        outline: none;
        border-color: #667eea;
    }

    @media (max-width: 768px) {
        .payment-card {
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        .payment-header {
            width: 100%;
        }

        .payment-right {
            text-align: left;
            width: 100%;
        }
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-failed {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-accepted {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-in_progress {
        background: #e0e7ff;
        color: #4338ca;
    }

    .status-delivered {
        background: #e9d5ff;
        color: #6b21a8;
    }

    .status-paid {
        background: #dcfce7;
        color: #166534;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2>💼 Payment History</h2>
            <select class="filter-select">
                <option value="all">All Time</option>
                <option value="month">This Month</option>
                <option value="week">This Week</option>
                <option value="today">Today</option>
            </select>
        </div>
        <p style="color: #666; margin-bottom: 25px;">All your payment transactions</p>

        @if($paidOrders->count() > 0)
            @foreach($paidOrders as $order)
                <div class="payment-card">
                    <div class="payment-header">
                        <div class="payment-icon">💳</div>
                        <div class="payment-info">
                            <div class="payment-title">{{ $order->job_title }}</div>
                            <div class="payment-meta">
                                Order #{{ $order->id }} • {{ $order->freelancer ? $order->freelancer->name : 'Unassigned' }} • {{ $order->paid_at ? $order->paid_at->format('d M Y') : $order->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="payment-right">
                        <div class="payment-amount negative">-${{ number_format($order->price, 2) }}</div>
                        <span class="status-badge status-{{ $order->status }}">
                            @if($order->status === 'completed')
                                ✓ Completed
                            @else
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            @endif
                        </span>
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
                <div class="payment-card" style="background: #fffef5; border-color: #ffeaa7;">
                    <div class="payment-header">
                        <div class="payment-icon" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.2), rgba(255, 193, 7, 0.2));">⏳</div>
                        <div class="payment-info">
                            <div class="payment-title">{{ $order->job_title }}</div>
                            <div class="payment-meta">
                                Order #{{ $order->id }} • {{ $order->created_at->format('d M Y') }}
                                @if($order->deadline)
                                    • Deadline: {{ \Carbon\Carbon::parse($order->deadline)->format('d M Y') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="payment-right">
                        <div class="payment-amount" style="color: #ff9800;">-${{ number_format($order->price, 2) }}</div>
                        <a href="{{ route('orders.payment', $order) }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px; display: inline-block; text-decoration: none;">💳 Pay Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
