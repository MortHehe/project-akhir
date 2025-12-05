<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - WORKZY</title>
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

        /* Navigation */
        nav {
            background: white;
            padding: 20px 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links a {
            margin-left: 30px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 60px 40px;
            color: white;
            text-align: center;
        }

        .page-header h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 18px;
            opacity: 0.95;
        }

        .secure-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            padding: 8px 20px;
            border-radius: 20px;
            margin-top: 15px;
            font-size: 14px;
        }

        /* Demo Mode Badge */
        .demo-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 193, 7, 0.9);
            color: #000;
            padding: 8px 20px;
            border-radius: 20px;
            margin-left: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            max-width: 1100px;
            margin: -40px auto 60px;
            padding: 0 60px;
        }

        .payment-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Payment Form */
        .payment-form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 40px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        /* Test Mode Controls */
        .test-controls {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .test-controls-title {
            font-size: 16px;
            font-weight: 700;
            color: #856404;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-outcome-selector {
            display: flex;
            gap: 15px;
        }

        .outcome-option {
            flex: 1;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .outcome-option:hover {
            border-color: #667eea;
        }

        .outcome-option.selected {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .outcome-option input[type="radio"] {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .outcome-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .outcome-label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .payment-methods {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .payment-method {
            flex: 1;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .payment-method:hover {
            border-color: #667eea;
        }

        .payment-method.active {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .payment-method input[type="radio"] {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .payment-method-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .payment-method-name {
            font-weight: 600;
            color: #333;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
        }

        .btn-pay {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-pay:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-pay:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .security-info {
            background: #f8f9ff;
            border: 1px solid #e1e8ed;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 13px;
            color: #666;
            text-align: center;
        }

        /* Order Summary */
        .order-summary-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .order-details {
            margin-bottom: 20px;
        }

        .order-item {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .order-description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .order-meta {
            font-size: 13px;
            color: #999;
            margin-bottom: 5px;
        }

        .summary-breakdown {
            border-top: 2px solid #f0f0f0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 15px;
        }

        .summary-row.total {
            border-top: 2px solid #f0f0f0;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 60px;
            margin-top: 60px;
            text-align: center;
        }

        footer p {
            opacity: 0.8;
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 968px) {
            .payment-container {
                grid-template-columns: 1fr;
            }

            .order-summary-card {
                position: static;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">WORKZY</div>
        <div class="nav-links">
            <a href="{{ route('welcome') }}">Home</a>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <a href="{{ route('orders.show', $order) }}">Back to Order</a>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Complete Payment</h1>
        <p>Demo Payment System - Test Mode</p>
        <div class="secure-badge">
            🔒 Secure SSL Encrypted Payment
        </div>
        <div class="demo-badge">
            ⚡ DEMO MODE - No Real Payment Required
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="payment-container">
            <!-- Payment Form -->
            <div class="payment-form-card">
                <div class="form-title">Payment Details</div>
                <div class="form-subtitle">Demo payment system - Control payment outcome for testing</div>

                <!-- Test Controls -->
                <div class="test-controls">
                    <div class="test-controls-title">
                        🧪 Test Controls (Demo Mode Only)
                    </div>
                    <div class="payment-outcome-selector">
                        <div class="outcome-option selected" onclick="selectOutcome('success', this)">
                            <input type="radio" name="payment_outcome" value="success" checked>
                            <div class="outcome-icon">✅</div>
                            <div class="outcome-label">Success</div>
                        </div>

                        <div class="outcome-option" onclick="selectOutcome('failure', this)">
                            <input type="radio" name="payment_outcome" value="failure">
                            <div class="outcome-icon">❌</div>
                            <div class="outcome-label">Failure</div>
                        </div>
                    </div>
                </div>

                <form id="payment-form" action="{{ route('orders.processPayment', $order) }}" method="POST">
                    @csrf

                    <!-- Payment Method Selection -->
                    <div class="payment-methods">
                        <div class="payment-method active" onclick="selectPaymentMethod('stripe', this)">
                            <input type="radio" name="payment_method" value="stripe" checked>
                            <div class="payment-method-icon">💳</div>
                            <div class="payment-method-name">Credit Card</div>
                        </div>

                        <div class="payment-method" onclick="selectPaymentMethod('paypal', this)">
                            <input type="radio" name="payment_method" value="paypal">
                            <div class="payment-method-icon">🅿️</div>
                            <div class="payment-method-name">PayPal</div>
                        </div>
                    </div>

                    <!-- Dummy Card Information -->
                    <div class="form-group">
                        <label>Cardholder Name (Demo - Any Name)</label>
                        <input type="text" id="cardholder-name" placeholder="John Doe" value="Test User">
                    </div>

                    <div class="form-group">
                        <label>Card Information (Demo - Any Number)</label>
                        <div class="form-row">
                            <input type="text" id="card-number" placeholder="4242 4242 4242 4242" value="4242 4242 4242 4242">
                            <input type="text" id="card-expiry" placeholder="12/25" value="12/25">
                            <input type="text" id="card-cvc" placeholder="123" value="123">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" value="{{ auth()->user()->email }}" readonly>
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>Phone</label>
                            <input type="tel" id="phone" value="{{ auth()->user()->phone ?? '+1 234 567 8900' }}">
                        </div>
                    </div>

                    <input type="hidden" name="stripeToken" id="stripe-token" value="test_token_demo">
                    <input type="hidden" name="payment_outcome" id="payment_outcome" value="success">

                    <button type="submit" class="btn-pay" id="submit-button">
                        <span id="button-text">Pay ${{ number_format($order->price, 2) }} (Demo)</span>
                        <span id="button-spinner" style="display: none;"><span class="spinner"></span> Processing...</span>
                    </button>

                    <div class="security-info">
                        🧪 <strong>Demo Mode:</strong> This is a test payment system. No real charges will be made. Use the controls above to simulate success or failure.
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="order-summary-card">
                <div class="summary-title">Order Summary</div>

                <div class="order-details">
                    <div class="order-item">{{ $order->job_title }}</div>
                    <div class="order-description">{{ Str::limit($order->job_description, 150) }}</div>

                    @if($order->freelancer)
                        <div class="order-meta">
                            👤 Freelancer: <strong>{{ $order->freelancer->name }}</strong>
                        </div>
                    @else
                        <div class="order-meta">
                            👤 Open to all freelancers
                        </div>
                    @endif

                    @if($order->deadline)
                        <div class="order-meta">
                            📅 Deadline: <strong>{{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}</strong>
                        </div>
                    @endif

                    <div class="order-meta">
                        📋 Status: <span class="badge badge-pending">{{ ucfirst($order->status) }}</span>
                    </div>
                </div>

                <div class="summary-breakdown">
                    <div class="summary-row">
                        <span>Project Cost</span>
                        <span>${{ number_format($order->price, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Platform Fee (5%)</span>
                        <span>${{ number_format($order->price * 0.05, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Processing Fee</span>
                        <span>${{ number_format($order->price * 0.029 + 0.30, 2) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total Amount</span>
                        <span>${{ number_format($order->price * 1.079 + 0.30, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 WORKZY. All rights reserved. | Demo Payment System for Testing</p>
    </footer>

    <script>
        // Payment outcome selection
        function selectOutcome(outcome, element) {
            document.querySelectorAll('.outcome-option').forEach(el => {
                el.classList.remove('selected');
            });
            element.classList.add('selected');
            document.getElementById('payment_outcome').value = outcome;
        }

        // Payment method selection
        function selectPaymentMethod(method, element) {
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', function(event) {
            // Disable submit button and show loading
            submitButton.disabled = true;
            document.getElementById('button-text').style.display = 'none';
            document.getElementById('button-spinner').style.display = 'inline';

            // Let the form submit normally - the backend will handle the outcome
        });
    </script>
</body>
</html>
