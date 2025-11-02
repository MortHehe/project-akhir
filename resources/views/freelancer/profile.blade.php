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
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
        
        .badge {
            background: #4CAF50;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
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
            border-color: #667eea;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        /* Skills */
        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .skill-tag {
            padding: 8px 16px;
            background: #e8eaf6;
            color: #667eea;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .skill-input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .skill-input-group input {
            flex: 1;
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
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
        }
        
        .btn-secondary {
            background: #f0f0f0;
            color: #666;
        }
        
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        
        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        /* Portfolio Items */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .portfolio-item {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .portfolio-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }
        
        .portfolio-image {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }
        
        .portfolio-info {
            padding: 15px;
        }
        
        .portfolio-info h3 {
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .portfolio-info p {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
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
            
            .portfolio-grid {
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
                    <a href="{{ route('freelancer.dashboard') }}" class="menu-item">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ route('freelancer.index') }}" class="menu-item">
                        <span>📦</span> My Orders
                    </a>
                    <a href="{{ route('reviews.index') }}" class="menu-item">
                        <span>⭐</span> Reviews
                    </a>
                </div>
                
                <div class="menu-section">
                    <div class="menu-label">Others</div>
                    <a href="{{ route('freelancer.settings') }}" class="menu-item">
                        <span>⚙️</span> Settings
                    </a>
                    <a href="{{ route('freelancer.earnings') }}" class="menu-item">
                        <span>💰</span> Earnings
                    </a>
                    <a href="{{ route('freelancer.profile') }}" class="menu-item active">
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
                    <span class="badge">Freelancer</span>
                    <span>▼</span>
                    
                    <div class="dropdown-menu">
                        <a href="{{ route('freelancer.dashboard') }}" class="dropdown-item">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ route('freelancer.profile') }}" class="dropdown-item">
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
                <p>Manage your public freelancer profile</p>
            </div>
            
            @php
                $user = auth()->user();
            @endphp
            
            <!-- Profile Header -->
            <div class="profile-header-card">
                <div class="profile-avatar-large">{{ substr($user->name, 0, 1) }}</div>
                <div class="profile-info">
                    <div class="profile-name">{{ $user->name }}</div>
                    <p style="color: #666; font-size: 16px; margin-bottom: 5px;">{{ $user->title ?? 'Professional Freelancer' }}</p>
                    <p style="color: #999; font-size: 14px;">📍 {{ $user->location ?? 'Location not set' }}</p>
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="value">{{ $user->average_rating }}</div>
                            <div class="label">⭐ Rating</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $user->total_reviews }}</div>
                            <div class="label">Reviews</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $user->freelancerOrders()->where('status', 'completed')->count() }}</div>
                            <div class="label">Completed</div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary">Edit Profile</button>
                </div>
            </div>
            
            <!-- About Section -->
            <div class="card">
                <div class="card-header">
                    <h2>📝 About Me</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('freelancer.profile.update') }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group">
                            <label>Professional Title</label>
                            <input type="text" name="title" value="{{ $user->title ?? '' }}" placeholder="e.g., Full Stack Developer, Graphic Designer">
                        </div>
                        
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea name="bio" placeholder="Tell clients about your experience and expertise...">{{ $user->bio ?? '' }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Hourly Rate (IDR)</label>
                            <input type="number" name="hourly_rate" value="{{ $user->hourly_rate ?? '' }}" placeholder="50000">
                        </div>
                        
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Skills Section -->
            <div class="card">
                <div class="card-header">
                    <h2>🎯 Skills & Expertise</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('freelancer.skills.update') }}">
                        @csrf
                        
                        <div class="skill-input-group">
                            <input type="text" id="skillInput" placeholder="Add a skill (e.g., Laravel, Photoshop)">
                            <button type="button" class="btn btn-primary btn-sm" onclick="addSkill()">Add Skill</button>
                        </div>
                        
                        <div class="skills-grid" id="skillsContainer">
                            @php
                                $skills = $user->skills ?? ['Laravel', 'PHP', 'JavaScript', 'React', 'Design'];
                            @endphp
                            
                            @foreach($skills as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                        </div>
                        
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Save Skills</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Portfolio Section -->
            <div class="card">
                <div class="card-header">
                    <h2>💼 Portfolio</h2>
                    <button class="btn btn-primary btn-sm">Add Project</button>
                </div>
                <div class="card-body">
                    <div class="portfolio-grid">
                        <!-- Sample Portfolio Items -->
                        <div class="portfolio-item">
                            <div class="portfolio-image">🎨</div>
                            <div class="portfolio-info">
                                <h3>Project Title 1</h3>
                                <p>Brief description of the project and technologies used.</p>
                            </div>
                        </div>
                        
                        <div class="portfolio-item">
                            <div class="portfolio-image">💻</div>
                            <div class="portfolio-info">
                                <h3>Project Title 2</h3>
                                <p>Brief description of the project and technologies used.</p>
                            </div>
                        </div>
                        
                        <div class="portfolio-item">
                            <div class="portfolio-image">📱</div>
                            <div class="portfolio-info">
                                <h3>Project Title 3</h3>
                                <p>Brief description of the project and technologies used.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Experience Section -->
            <div class="card">
                <div class="card-header">
                    <h2>💼 Work Experience</h2>
                    <button class="btn btn-primary btn-sm">Add Experience</button>
                </div>
                <div class="card-body">
                    <div class="empty-state">
                        <div class="icon">💼</div>
                        <h3>No Experience Added</h3>
                        <p>Add your work experience to build credibility</p>
                        <button class="btn btn-primary">Add Your First Experience</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        function addSkill() {
            const input = document.getElementById('skillInput');
            const skill = input.value.trim();
            
            if (skill) {
                const container = document.getElementById('skillsContainer');
                const skillTag = document.createElement('span');
                skillTag.className = 'skill-tag';
                skillTag.textContent = skill;
                container.appendChild(skillTag);
                input.value = '';
            }
        }
        
        // Allow Enter key to add skill
        document.getElementById('skillInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addSkill();
            }
        });
    </script>
</body>
</html>
