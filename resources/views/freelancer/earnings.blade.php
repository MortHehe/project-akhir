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

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        overflow-y: auto;
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        padding: 40px;
        border-radius: 20px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .modal-header h2 {
        font-size: 24px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .modal-header p {
        color: #666;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #4CAF50;
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-hint {
        font-size: 12px;
        color: #999;
        margin-top: 5px;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-submit {
        flex: 1;
        padding: 14px;
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }

    .btn-cancel {
        flex: 1;
        padding: 14px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #5a6268;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 2px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 2px solid #f5c6cb;
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

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">✗ {{ session('error') }}</div>
    @endif

    @php
        $user = auth()->user();
        $totalEarnings = $user->getTotalEarningsAttribute() ?? 0;

        // Calculate total withdrawals (pending, approved, and sent)
        $totalWithdrawals = $user->withdrawals()
            ->whereIn('status', ['pending', 'approved', 'sent'])
            ->sum('amount') ?? 0;

        // Available balance = (Total earnings * 85%) - Total withdrawals
        $availableBalance = ($totalEarnings * 0.85) - $totalWithdrawals;
        $availableBalance = max(0, $availableBalance); // Ensure it's never negative

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
            <button class="btn-white" onclick="openWithdrawModal()">💵 Withdraw Funds</button>
            <button class="btn-outline" onclick="scrollToHistory()">📜 View History</button>
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
    <div class="card" id="withdrawal-history">
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
            // Get completed orders (earnings)
            $completedOrders = $user->freelancerOrders()
                ->where('status', 'completed')
                ->with('user')
                ->get()
                ->map(function($order) {
                    return [
                        'type' => 'earning',
                        'title' => $order->job_title,
                        'description' => 'From ' . $order->user->name,
                        'amount' => $order->price,
                        'date' => $order->updated_at,
                        'status' => 'completed',
                        'icon' => '💰'
                    ];
                });

            // Get withdrawals
            $withdrawals = $user->withdrawals()
                ->get()
                ->map(function($withdrawal) {
                    return [
                        'type' => 'withdrawal',
                        'title' => 'Withdrawal Request',
                        'description' => ucfirst(str_replace('_', ' ', $withdrawal->payment_method)),
                        'amount' => -$withdrawal->amount,
                        'date' => $withdrawal->requested_at,
                        'status' => $withdrawal->status,
                        'icon' => '🏦'
                    ];
                });

            // Merge and sort by date (newest first)
            $allTransactions = $completedOrders->merge($withdrawals)
                ->sortByDesc('date')
                ->take(20);
        @endphp

        @forelse($allTransactions as $transaction)
            <div class="transaction-item">
                <div class="transaction-left">
                    <div class="transaction-icon {{ $transaction['type'] === 'earning' ? 'income' : '' }}">
                        {{ $transaction['icon'] }}
                    </div>
                    <div class="transaction-info">
                        <h3>{{ $transaction['title'] }}</h3>
                        <p>{{ $transaction['description'] }} • {{ $transaction['date']->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="transaction-amount">
                    <div class="amount" style="color: {{ $transaction['type'] === 'earning' ? '#4CAF50' : '#dc3545' }};">
                        {{ $transaction['amount'] >= 0 ? '+' : '' }}${{ number_format(abs($transaction['amount']), 2) }}
                    </div>
                    @if($transaction['type'] === 'earning')
                        <span class="status status-completed">✓ Completed</span>
                    @else
                        <span class="status" style="background:
                            @if($transaction['status'] === 'pending') rgba(255, 193, 7, 0.15); color: #856404
                            @elseif($transaction['status'] === 'approved') rgba(13, 202, 240, 0.15); color: #055160
                            @elseif($transaction['status'] === 'sent') rgba(76, 175, 80, 0.15); color: #2e7d32
                            @else rgba(220, 53, 69, 0.15); color: #721c24
                            @endif;">
                            @if($transaction['status'] === 'pending') ⏳ Pending
                            @elseif($transaction['status'] === 'approved') ✓ Approved
                            @elseif($transaction['status'] === 'sent') ✅ Sent
                            @else ✗ Rejected
                            @endif
                        </span>
                    @endif
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

    <!-- Withdraw Modal -->
    <div id="withdrawModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>💵 Withdraw Funds</h2>
                <p>Available balance: <strong>${{ number_format($availableBalance, 2) }}</strong></p>
            </div>

            <form action="{{ route('freelancer.withdraw') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="amount">Amount ($)</label>
                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        class="form-input"
                        placeholder="Enter amount"
                        min="50"
                        max="{{ $availableBalance }}"
                        step="0.01"
                        required
                    >
                    <div class="form-hint">Minimum withdrawal: $50.00</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="payment_method">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="form-select" required>
                        <option value="">Select payment method</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="payment_details">Payment Details</label>
                    <textarea
                        id="payment_details"
                        name="payment_details"
                        class="form-textarea"
                        placeholder="Enter your bank account details or PayPal email..."
                        required
                        maxlength="500"
                    ></textarea>
                    <div class="form-hint">For Bank: Account number, Bank name, Account holder name. For PayPal: Your PayPal email address.</div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeWithdrawModal()">Cancel</button>
                    <button type="submit" class="btn-submit">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openWithdrawModal() {
            document.getElementById('withdrawModal').classList.add('active');
        }

        function closeWithdrawModal() {
            document.getElementById('withdrawModal').classList.remove('active');
        }

        function scrollToHistory() {
            document.getElementById('withdrawal-history').scrollIntoView({ behavior: 'smooth' });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('withdrawModal');
            if (event.target == modal) {
                closeWithdrawModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeWithdrawModal();
            }
        });
    </script>
@endsection
