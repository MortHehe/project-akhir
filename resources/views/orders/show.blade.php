@extends('layouts.auth')

@section('title', 'Order #' . $order->id)
@section('menu-orders', 'active')

@section('additional-styles')
<style>
    /* Alerts */
    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border: 2px solid #c3e6cb;
    }

    .alert-info {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
        border: 2px solid #bee5eb;
    }

    .alert-error {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border: 2px solid #f5c6cb;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px;
        border-radius: 16px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
    }

    .page-header h1 {
        font-size: 36px;
        margin-bottom: 8px;
        font-weight: 900;
    }

    .page-header p {
        font-size: 18px;
        opacity: 0.95;
        font-weight: 600;
    }

    /* Order Container */
    .order-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .order-details-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        padding: 40px;
        border: 2px solid #f0f0f0;
    }

    .card-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-row {
        display: grid;
        grid-template-columns: 180px 1fr;
        padding: 18px 0;
        border-bottom: 1px solid #f0f0f0;
        gap: 20px;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 700;
        color: #666;
        font-size: 15px;
    }

    .detail-value {
        color: #333;
        font-weight: 600;
        font-size: 15px;
    }

    .description-text {
        line-height: 1.8;
        white-space: pre-wrap;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 8px 18px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
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
        background: linear-gradient(135deg, #cce5ff 0%, #b3d7ff 100%);
        color: #004085;
    }

    .status-completed {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .status-delivered {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .status-cancelled, .status-rejected {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    /* Order Summary Card */
    .order-summary-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        padding: 30px;
        height: fit-content;
        position: sticky;
        top: 20px;
        border: 2px solid #f0f0f0;
    }

    .summary-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-label {
        color: #666;
        font-size: 14px;
        font-weight: 600;
    }

    .summary-value {
        color: #333;
        font-weight: 700;
    }

    .summary-total {
        border-top: 2px solid #667eea;
        margin-top: 15px;
        padding-top: 15px;
        font-size: 20px;
        font-weight: 900;
        color: #667eea;
    }

    /* Freelancer Actions Section */
    .freelancer-actions-card {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border: 2px solid #667eea;
        border-radius: 16px;
        padding: 30px;
        margin-top: 30px;
    }

    .actions-title {
        font-size: 20px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Action Buttons */
    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 20px;
    }

    .action-buttons.full {
        grid-template-columns: 1fr;
    }

    .btn {
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
    }

    .btn-accept {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-accept:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .btn-reject {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }

    .btn-progress {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-progress:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-deliver {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
    }

    .btn-deliver:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4);
    }

    .btn-secondary {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
    }

    .btn-secondary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-back {
        background: #6c757d;
        color: white;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
    }

    /* Status Update Form */
    .status-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        font-weight: 700;
        color: #333;
        font-size: 14px;
    }

    .form-select {
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        outline: none;
        transition: all 0.3s;
    }

    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    @media (max-width: 968px) {
        .order-container {
            grid-template-columns: 1fr;
        }

        .order-summary-card {
            position: static;
        }

        .detail-row {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1>📋 Order #{{ $order->id }}</h1>
        <p>{{ $order->job_title }}</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">ℹ {{ session('info') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">✗ {{ session('error') }}</div>
    @endif

    <div class="order-container">
        <!-- Order Details -->
        <div class="order-details-card">
            <div class="card-title">
                📄 Order Details
            </div>

            <div class="detail-row">
                <div class="detail-label">Order ID</div>
                <div class="detail-value">#{{ $order->id }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Status</div>
                <div class="detail-value">
                    <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Project Title</div>
                <div class="detail-value">{{ $order->job_title }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Description</div>
                <div class="detail-value">
                    <div class="description-text">{{ $order->job_description ?? 'No description provided' }}</div>
                </div>
            </div>

            @if($order->requirements)
                <div class="detail-row">
                    <div class="detail-label">Requirements</div>
                    <div class="detail-value">
                        <div class="description-text">{{ $order->requirements }}</div>
                    </div>
                </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">Budget</div>
                <div class="detail-value">${{ number_format($order->price, 2) }}</div>
            </div>

            @if($order->deadline)
                <div class="detail-row">
                    <div class="detail-label">Deadline</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}</div>
                </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">Client</div>
                <div class="detail-value">{{ $order->user->name }} ({{ $order->user->email }})</div>
            </div>

            @if($order->freelancer)
                <div class="detail-row">
                    <div class="detail-label">Freelancer</div>
                    <div class="detail-value">{{ $order->freelancer->name }} ({{ $order->freelancer->email }})</div>
                </div>
            @else
                <div class="detail-row">
                    <div class="detail-label">Freelancer</div>
                    <div class="detail-value">Open to all freelancers</div>
                </div>
            @endif

            @if($order->payment_method)
                <div class="detail-row">
                    <div class="detail-label">Payment Method</div>
                    <div class="detail-value">{{ ucfirst($order->payment_method) }}</div>
                </div>
            @endif

            @if($order->paid_at)
                <div class="detail-row">
                    <div class="detail-label">Paid At</div>
                    <div class="detail-value">{{ $order->paid_at->format('M d, Y H:i A') }}</div>
                </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">Created</div>
                <div class="detail-value">{{ $order->created_at->format('M d, Y H:i A') }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Last Updated</div>
                <div class="detail-value">{{ $order->updated_at->format('M d, Y H:i A') }}</div>
            </div>

            @if(auth()->user()->isFreelancer() && $order->freelancer_id === auth()->id())
                <!-- Freelancer Actions -->
                <div class="freelancer-actions-card">
                    <div class="actions-title">
                        ⚡ Freelancer Actions
                    </div>

                    @if($order->status === 'paid')
                        <!-- Accept or Reject Order -->
                        <p style="color: #666; margin-bottom: 15px; font-weight: 600;">This order is ready for you to accept or reject.</p>
                        <div class="action-buttons">
                            <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="btn btn-accept">
                                    ✓ Accept Order
                                </button>
                            </form>
                            <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-reject">
                                    ✗ Reject Order
                                </button>
                            </form>
                        </div>
                    @elseif($order->status === 'accepted')
                        <!-- Start Progress -->
                        <p style="color: #666; margin-bottom: 15px; font-weight: 600;">You have accepted this order. Start working on it!</p>
                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="in_progress">
                            <div class="action-buttons full">
                                <button type="submit" class="btn btn-progress">
                                    🚀 Start Progress
                                </button>
                            </div>
                        </form>
                    @elseif($order->status === 'in_progress')
                        <!-- Mark as Delivered -->
                        <p style="color: #666; margin-bottom: 15px; font-weight: 600;">You are currently working on this order. Mark it as delivered when complete!</p>
                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="delivered">
                            <div class="action-buttons full">
                                <button type="submit" class="btn btn-deliver">
                                    ✓ Mark as Delivered
                                </button>
                            </div>
                        </form>
                    @elseif($order->status === 'delivered')
                        <p style="color: #28a745; font-weight: 700; margin-bottom: 0;">✓ Order has been delivered! Waiting for client approval.</p>
                    @elseif($order->status === 'completed')
                        <p style="color: #28a745; font-weight: 700; margin-bottom: 0;">🎉 Order completed successfully!</p>
                    @elseif($order->status === 'rejected')
                        <p style="color: #dc3545; font-weight: 700; margin-bottom: 0;">✗ You have rejected this order.</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="order-summary-card">
            <div class="summary-title">💰 Payment Summary</div>

            <div class="summary-item">
                <span class="summary-label">Project Cost</span>
                <span class="summary-value">${{ number_format($order->price, 2) }}</span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Platform Fee (5%)</span>
                <span class="summary-value">${{ number_format($order->price * 0.05, 2) }}</span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Processing Fee</span>
                <span class="summary-value">${{ number_format($order->price * 0.029 + 0.30, 2) }}</span>
            </div>

            <div class="summary-item summary-total">
                <span class="summary-label">Total Paid</span>
                <span class="summary-value">${{ number_format($order->price * 1.079 + 0.30, 2) }}</span>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons" style="margin-top: 20px;">
                @if(!auth()->user()->isFreelancer() && $order->status === 'pending')
                    <a href="{{ route('orders.payment', $order) }}" class="btn btn-progress" style="grid-column: 1 / -1;">
                        💳 Complete Payment
                    </a>
                @endif

                @if($order->user_id === auth()->id() && $order->freelancer)
                    <a href="{{ route('chat.show', $order->freelancer->id) }}" class="btn btn-secondary">
                        💬 Message Freelancer
                    </a>
                @endif

                @if(auth()->user()->isFreelancer() && $order->user)
                    <a href="{{ route('chat.show', $order->user->id) }}" class="btn btn-secondary">
                        💬 Message Client
                    </a>
                @endif

                <a href="{{ route('orders.index') }}" class="btn btn-back">
                    ← Back to Orders
                </a>
            </div>
        </div>
    </div>
@endsection
