<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - WORKZY</title>
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
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            padding: 30px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }
        
        .logo {
            padding: 0 30px;
            margin-bottom: 50px;
        }
        
        .logo h2 {
            font-size: 24px;
            font-weight: bold;
        }
        
        .menu-section {
            padding: 0 30px;
            margin-bottom: 30px;
        }
        
        .menu-label {
            color: #999;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        
        .menu-item {
            padding: 12px 30px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #666;
            font-size: 14px;
            text-decoration: none;
        }
        
        .menu-item:hover {
            background: #f5f5f5;
            color: #000;
        }
        
        .menu-item.active {
            background: #000;
            color: white;
            font-weight: 600;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px 40px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 10px 20px;
            border-radius: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: relative;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: #2196F3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
        
        .badge {
            background: #2196F3;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .user-info:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .dropdown-item:hover {
            background: #f5f5f5;
        }
        
        .dropdown-item.logout {
            color: #e74c3c;
        }
        
        .dropdown-item button {
            background: none;
            border: none;
            color: inherit;
            font: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 0;
        }
        
        .page-header {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .page-header p {
            opacity: 0.9;
            font-size: 15px;
        }
        
        /* Profile Header Card */
        .profile-header-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 40px;
            margin-bottom: 30px;
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .profile-avatar-large {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: bold;
        }
        
        .profile-info {
            flex: 1;
        }
        
        .profile-name {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .profile-stats {
            display: flex;
            gap: 30px;
            margin-top: 20px;
        }
        
        .profile-stat {
            text-align: center;
        }
        
        .profile-stat .value {
            font-size: 24px;
            font-weight: bold;
            color: #2196F3;
        }
        
        .profile-stat .label {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        
        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            padding: 25px 30px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h2 {
            font-size: 18px;
            color: #1a1a1a;
        }
        
        .card-body {
            padding: 30px;
        }
        
        /* Form Elements */
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
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2196F3;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #2196F3;
            color: white;
        }
        
        .btn-primary:hover {
            background: #1976D2;
        }
        
        .btn-secondary {
            background: #f0f0f0;
            color: #666;
        }
        
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        /* Preferences */
        .preference-item {
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .preference-icon {
            width: 50px;
            height: 50px;
            background: #e3f2fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .preference-info {
            flex: 1;
        }
        
        .preference-info h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }
        
        .preference-info p {
            font-size: 13px;
            color: #666;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-state .icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #1a1a1a;
        }
        
        .empty-state p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .profile-header-card {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-stats {
                justify-content: center;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>⚫ WORKZY</h2>
            </div>
            
            <nav class="menu">
                <div class="menu-section">
                    <div class="menu-label">Menu</div>
                    <a href="{{ route('user.dashboard') }}" class="menu-item">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('user.projects') }}" class="menu-item">
                        <span>📂</span> My Projects
                    </a>
                    <a href="{{ route('user.find-freelancers') }}" class="menu-item">
                        <span>🔍</span> Find Freelancers
                    </a>
                </div>
                
                <div class="menu-section">
                    <div class="menu-label">Others</div>
                    <a href="{{ route('user.settings') }}" class="menu-item">
                        <span>⚙️</span> Settings
                    </a>
                    <a href="{{ route('user.payments') }}" class="menu-item">
                        <span>💳</span> Payments
                    </a>
                    <a href="{{ route('user.profile') }}" class="menu-item active">
                        <span>👤</span> Profile
                    </a>
                </div>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="header">
                <div></div>
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                    <span class="badge">Client</span>
                    <span>▼</span>
                    
                    <div class="dropdown-menu">
                        <a href="{{ route('user.dashboard') }}" class="dropdown-item">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('user.profile') }}" class="dropdown-item">
                            <span>👤</span> My Profile
                        </a>
                        <div class="dropdown-item logout">
                            <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                                @csrf
                                <button type="submit">
                                    <span>🚪</span> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-header">
                <h1>👤 My Profile</h1>
                <p>Manage your profile and company information</p>
            </div>
            
            @php
                $user = auth()->user();
                $activeProjects = $user->clientOrders()->whereIn('status', ['in_progress', 'pending'])->count();
                $completedProjects = $user->clientOrders()->where('status', 'completed')->count();
                $totalSpent = $user->clientOrders()->where('status', 'completed')->sum('price') ?? 0;
            @endphp
            
            <!-- Profile Header -->
            <div class="profile-header-card">
                <div class="profile-avatar-large">{{ substr($user->name, 0, 1) }}</div>
                <div class="profile-info">
                    <div class="profile-name">{{ $user->name }}</div>
                    <p style="color: #666; font-size: 16px; margin-bottom: 5px;">{{ $user->company ?? 'Individual Client' }}</p>
                    <p style="color: #999; font-size: 14px;">📍 {{ $user->location ?? 'Location not set' }}</p>
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="value">{{ $activeProjects }}</div>
                            <div class="label">Active Projects</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $completedProjects }}</div>
                            <div class="label">Completed</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">IDR {{ number_format($totalSpent / 1000000, 1) }}M</div>
                            <div class="label">Total Spent</div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary">Edit Profile</button>
                </div>
            </div>
            
            <!-- Personal Information -->
            <div class="card">
                <div class="card-header">
                    <h2>📝 Personal Information</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" value="{{ $user->phone ?? '' }}" placeholder="+62 xxx xxxx xxxx">
                            </div>
                            
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" value="{{ $user->location ?? '' }}" placeholder="City, Country">
                            </div>
                        </div>
                        
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Company Information -->
            <div class="card">
                <div class="card-header">
                    <h2>🏢 Company Information</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.company.update') }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company" value="{{ $user->company ?? '' }}" placeholder="Your Company Name">
                            </div>
                            
                            <div class="form-group">
                                <label>Industry</label>
                                <select name="industry">
                                    <option value="">Select Industry</option>
                                    <option value="technology">Technology</option>
                                    <option value="finance">Finance</option>
                                    <option value="healthcare">Healthcare</option>
                                    <option value="education">Education</option>
                                    <option value="retail">Retail</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Company Size</label>
                                <select name="company_size">
                                    <option value="">Select Size</option>
                                    <option value="1-10">1-10 employees</option>
                                    <option value="11-50">11-50 employees</option>
                                    <option value="51-200">51-200 employees</option>
                                    <option value="201-500">201-500 employees</option>
                                    <option value="500+">500+ employees</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Website</label>
                                <input type="url" name="website" value="{{ $user->website ?? '' }}" placeholder="https://yourcompany.com">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Company Description</label>
                            <textarea name="company_description" placeholder="Tell us about your company...">{{ $user->company_description ?? '' }}</textarea>
                        </div>
                        
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Hiring Preferences -->
            <div class="card">
                <div class="card-header">
                    <h2>🎯 Hiring Preferences</h2>
                </div>
                <div class="card-body">
                    <div class="preference-item">
                        <div class="preference-icon">💼</div>
                        <div class="preference-info">
                            <h3>Project Types</h3>
                            <p>Web Development, Mobile Apps, Graphic Design</p>
                        </div>
                        <button class="btn btn-secondary">Edit</button>
                    </div>
                    
                    <div class="preference-item">
                        <div class="preference-icon">💰</div>
                        <div class="preference-info">
                            <h3>Budget Range</h3>
                            <p>IDR 1,000,000 - IDR 10,000,000 per project</p>
                        </div>
                        <button class="btn btn-secondary">Edit</button>
                    </div>
                    
                    <div class="preference-item">
                        <div class="preference-icon">🌍</div>
                        <div class="preference-info">
                            <h3>Preferred Locations</h3>
                            <p>Indonesia, Singapore, Malaysia</p>
                        </div>
                        <button class="btn btn-secondary">Edit</button>
                    </div>
                </div>
            </div>
            
            <!-- Saved Freelancers -->
            <div class="card">
                <div class="card-header">
                    <h2>⭐ Saved Freelancers</h2>
                </div>
                <div class="card-body">
                    <div class="empty-state">
                        <div class="icon">⭐</div>
                        <h3>No Saved Freelancers</h3>
                        <p>Save your favorite freelancers for quick access</p>
                        <button class="btn btn-primary">Find Freelancers</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
