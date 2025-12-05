@extends('layouts.auth')

@section('title', 'Earnings')
@section('menu-earnings', 'active')

@section('additional-styles')
<style>
    /* Balance Card */
    .balance-card {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(76, 175, 80, 0.3);
        width: 100%;
        box-sizing: border-box;
        overflow: visible;
    }

    .balance-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .balance-header h2 {
        font-size: 18px;
        opacity: 0.95;
        font-weight: 600;
    }

    .balance-amount {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 25px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        word-break: break-all;
        line-height: 1.2;
    }

    .balance-actions {
        display: flex;
        gap: 15px;
    }

    .btn-white {
        background: white;
        color: #4CAF50;
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .btn-outline {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid white;
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Transaction Item */
    .transaction-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px;
        border: 2px solid #f0f0f0;
        border-radius: 16px;
        margin-bottom: 20px;
        transition: all 0.3s;
        background: white;
    }

    .transaction-item:hover {
        border-color: #667eea;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
        transform: translateX(5px);
    }

    .transaction-left {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .transaction-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    }

    .transaction-icon.income {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.15), rgba(69, 160, 73, 0.15));
    }

    .transaction-info h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1a1a1a;
    }

    .transaction-info p {
        font-size: 14px;
        color: #666;
    }

    .transaction-amount {
        text-align: right;
    }

    .transaction-amount .amount {
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .transaction-amount .amount.income {
        color: #4CAF50;
    }

    .transaction-amount .status {
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 700;
    }

    .status-completed {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.15), rgba(69, 160, 73, 0.15));
        color: #2e7d32;
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

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 72px;
        margin-bottom: 25px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 22px;
        margin-bottom: 12px;
        color: #333;
        font-weight: 700;
    }

    .empty-state p {
        color: #666;
        font-size: 15px;
    }

    @media (max-width: 968px) {
        .balance-amount {
            font-size: 38px;
        }

        .balance-actions {
            flex-direction: column;
        }

        .transaction-item {
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        .transaction-amount {
            text-align: left;
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>💰 Earnings</h1>
        <p>Track your income and manage withdrawals</p>
    </div>

    @php
        $user = auth()->user();
        $totalEarnings = $user->getTotalEarningsAttribute() ?? 0;
        $availableBalance = $totalEarnings * 0.85; // 85% after platform fee
        $pendingEarnings = $user->freelancerOrders()->where('status', 'in_progress')->sum('price') ?? 0;
        $thisMonthEarnings = $user->freelancerOrders()
            ->where('status', 'completed')
            ->whereMonth('updated_at', now()->month)
            ->sum('price') ?? 0;
    @endphp

    <!-- Available Balance -->
    <div class="balance-card">
        <div class="balance-header">
            <h2>💳 Available Balance</h2>
            <span style="font-size: 24px;">💸</span>
        </div>
        <div class="balance-amount">${{ number_format($availableBalance, 2) }}</div>
        <div class="balance-actions">
            <button class="btn-white">💵 Withdraw Funds</button>
            <button class="btn-outline">📜 View History</button>
        </div>
    </div>

    <!-- Earnings Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <span class="icon">💵</span>
            <div class="label">Total Earnings</div>
            <div class="value">${{ number_format($totalEarnings, 0) }}</div>
            <div class="change">📈 All time earnings</div>
        </div>

        <div class="stat-card">
            <span class="icon">⏳</span>
            <div class="label">Pending Earnings</div>
            <div class="value">${{ number_format($pendingEarnings, 0) }}</div>
            <div class="change">🔄 In progress orders</div>
        </div>

        <div class="stat-card">
            <span class="icon">📅</span>
            <div class="label">This Month</div>
            <div class="value">${{ number_format($thisMonthEarnings, 0) }}</div>
            <div class="change">{{ now()->format('F Y') }}</div>
        </div>

        <div class="stat-card">
            <span class="icon">✅</span>
            <div class="label">Completed Orders</div>
            <div class="value">{{ $user->freelancerOrders()->where('status', 'completed')->count() }}</div>
            <div class="change">Total completed</div>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2>💼 Transaction History</h2>
            <select class="filter-select">
                <option value="all">All Time</option>
                <option value="month">This Month</option>
                <option value="week">This Week</option>
                <option value="today">Today</option>
            </select>
        </div>

        @php
            $transactions = $user->freelancerOrders()
                ->where('status', 'completed')
                ->with('user')
                ->latest()
                ->take(10)
                ->get();
        @endphp

        @forelse($transactions as $transaction)
            <div class="transaction-item">
                <div class="transaction-left">
                    <div class="transaction-icon income">
                        💰
                    </div>
                    <div class="transaction-info">
                        <h3>{{ $transaction->job_title }}</h3>
                        <p>From {{ $transaction->user->name }} • {{ $transaction->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="transaction-amount">
                    <div class="amount income">+${{ number_format($transaction->price, 2) }}</div>
                    <span class="status status-completed">✓ Completed</span>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">💸</div>
                <h3>No Transactions Yet</h3>
                <p>Complete your first order to see your earnings here!</p>
            </div>
        @endforelse
    </div>

    <!-- Withdrawal History -->
    <div class="card">
        <h2>🏦 Withdrawal History</h2>
        <p style="color: #666; margin-bottom: 25px;">Track all your withdrawal requests</p>

        <div class="empty-state">
            <div class="empty-state-icon">🏦</div>
            <h3>No Withdrawals Yet</h3>
            <p>Your withdrawal history will appear here once you make your first withdrawal</p>
        </div>
    </div>
@endsection
