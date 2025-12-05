@extends('layouts.auth')

@section('title', 'Settings')
@section('menu-settings', 'active')

@section('additional-styles')
<style>
    /* Toggle Switch */
    .toggle-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .toggle-group:last-child {
        border-bottom: none;
    }

    .toggle-info h3 {
        font-size: 16px;
        color: #1a1a1a;
        margin-bottom: 5px;
        font-weight: 700;
    }

    .toggle-info p {
        font-size: 13px;
        color: #666;
    }

    .toggle-switch {
        position: relative;
        width: 56px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 30px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    .toggle-switch input:checked + .toggle-slider {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }

    .btn-group {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.4;
    }

    .empty-state h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>⚙️ Settings</h1>
        <p>Manage your account settings and preferences</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- Account Settings -->
    <div class="card">
        <h2>👤 Account Settings</h2>
        <p style="color: #666; margin-bottom: 25px;">Update your account information</p>

        <form method="POST" action="{{ route('user.settings.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="+1 234 567 8900">
                </div>

                <div class="form-group">
                    <label>Company Name (Optional)</label>
                    <input type="text" name="company" value="{{ auth()->user()->company ?? '' }}" placeholder="Your Company">
                </div>
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ auth()->user()->location ?? '' }}" placeholder="City, Country">
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                <button type="reset" class="btn btn-secondary">↺ Reset</button>
            </div>
        </form>
    </div>

    <!-- Change Password -->
    <div class="card">
        <h2>🔒 Change Password</h2>
        <p style="color: #666; margin-bottom: 25px;">Update your password to keep your account secure</p>

        <form method="POST" action="{{ route('user.password.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required placeholder="Enter current password">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" required placeholder="Enter new password">
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" required placeholder="Confirm new password">
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">🔑 Update Password</button>
            </div>
        </form>
    </div>

    <!-- Notification Settings -->
    <div class="card">
        <h2>🔔 Notification Preferences</h2>
        <p style="color: #666; margin-bottom: 25px;">Manage how you receive notifications</p>

        <form method="POST" action="{{ route('user.notifications.update') }}">
            @csrf
            @method('PATCH')

            <div class="toggle-group">
                <div class="toggle-info">
                    <h3>📧 Email Notifications</h3>
                    <p>Receive email updates about your projects</p>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="email_notifications" checked>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="toggle-group">
                <div class="toggle-info">
                    <h3>📂 Project Updates</h3>
                    <p>Get notified when freelancers submit work</p>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="project_notifications" checked>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="toggle-group">
                <div class="toggle-info">
                    <h3>💬 New Messages</h3>
                    <p>Receive alerts for new messages from freelancers</p>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="message_notifications" checked>
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="toggle-group">
                <div class="toggle-info">
                    <h3>📰 Marketing Emails</h3>
                    <p>Receive tips, updates, and promotional content</p>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" name="marketing_emails">
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">💾 Save Preferences</button>
            </div>
        </form>
    </div>

    <!-- Payment Methods -->
    <div class="card">
        <h2>💳 Payment Methods</h2>
        <p style="color: #666; margin-bottom: 25px;">Manage your payment options</p>

        <div class="empty-state">
            <div class="empty-state-icon">💳</div>
            <h3>No Payment Methods</h3>
            <p>Add a payment method to make payments easier and faster</p>
            <button class="btn btn-primary">➕ Add Payment Method</button>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="card" style="border: 2px solid #ffebee;">
        <h2 style="color: #e74c3c;">⚠️ Danger Zone</h2>
        <p style="color: #666; margin-bottom: 25px;">Irreversible and destructive actions</p>

        <div class="alert alert-warning">
            <strong>⚠️ Warning:</strong> Deleting your account is permanent and cannot be undone. All your data, orders, and messages will be permanently lost.
        </div>

        <form method="POST" action="{{ route('user.account.delete') }}" onsubmit="return confirm('⚠️ Are you absolutely sure you want to delete your account?\n\nThis action cannot be undone and you will lose:\n• All your orders and history\n• All your messages\n• All your account data\n\nType DELETE to confirm.');">
            @csrf
            @method('DELETE')

            <div class="btn-group">
                <button type="submit" class="btn btn-danger">🗑️ Delete Account Permanently</button>
            </div>
        </form>
    </div>
@endsection
