@extends('layouts.auth')

@section('title', 'My Profile')
@section('menu-profile', 'active')

@section('additional-styles')
<style>
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .profile-card {
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        text-align: center;
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 48px;
        margin: 0 auto 20px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .profile-name {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        color: #1a1a1a;
    }

    .profile-email {
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        margin-top: 5px;
        font-weight: 600;
    }

    .btn-group {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    @media (max-width: 968px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>👤 My Profile</h1>
        <p>View and manage your profile information</p>
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

    <div class="profile-grid">
        <!-- Profile Summary -->
        <div class="profile-card">
            <div class="profile-avatar-large">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="profile-name">{{ auth()->user()->name }}</div>
            <div class="profile-email">{{ auth()->user()->email }}</div>
            <span class="badge" style="display: inline-block;">Client Account</span>

            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ auth()->user()->clientOrders()->count() }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ auth()->user()->clientOrders()->where('status', 'completed')->count() }}</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>

            <div class="btn-group" style="flex-direction: column;">
                <a href="{{ route('user.settings') }}" class="btn btn-primary">⚙️ Edit Settings</a>
                <a href="{{ route('orders.create') }}" class="btn btn-secondary">➕ Create Order</a>
            </div>
        </div>

        <!-- Profile Details -->
        <div>
            <div class="card">
                <h2>📋 Personal Information</h2>
                <p style="color: #666; margin-bottom: 25px;">Update your personal details</p>

                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" value="{{ auth()->user()->email }}" disabled style="background: #f5f5f5;">
                            <small style="color: #999; font-size: 12px; display: block; margin-top: 5px;">Email cannot be changed here. Go to Settings to update.</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="+1 234 567 8900">
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" value="{{ auth()->user()->location ?? '' }}" placeholder="City, Country">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Bio (Optional)</label>
                        <textarea name="bio" rows="4" placeholder="Tell us about yourself...">{{ auth()->user()->bio ?? '' }}</textarea>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                        <button type="reset" class="btn btn-secondary">↺ Reset</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>🏢 Company Information</h2>
                <p style="color: #666; margin-bottom: 25px;">Optional company details for invoicing</p>

                <form method="POST" action="{{ route('user.company.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="company" value="{{ auth()->user()->company ?? '' }}" placeholder="Your Company Name">
                    </div>

                    <div class="form-group">
                        <label>Company Address</label>
                        <textarea name="company_address" rows="3" placeholder="Street Address, City, State, ZIP">{{ auth()->user()->company_address ?? '' }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tax ID / VAT Number</label>
                            <input type="text" name="tax_id" value="{{ auth()->user()->tax_id ?? '' }}" placeholder="XX-XXXXXXX">
                        </div>

                        <div class="form-group">
                            <label>Company Website</label>
                            <input type="url" name="website" value="{{ auth()->user()->website ?? '' }}" placeholder="https://example.com">
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">💾 Save Company Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
