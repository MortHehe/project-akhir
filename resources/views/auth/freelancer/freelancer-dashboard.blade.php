<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard - WORKZY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }
        
        .header {
            background: white;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: -1px;
        }
        
        .nav {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .nav a {
            color: #333;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        .nav a:hover {
            color: #000;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 30px;
            border-left: 1px solid #e0e0e0;
        }
        
        .user-name {
            font-weight: 600;
            color: #333;
        }
        
        .badge {
            background: #4CAF50;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .btn-logout {
            background: #000;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .welcome-card h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .welcome-card p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #c3e6cb;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .stat-card .change {
            font-size: 14px;
            color: #4CAF50;
            margin-top: 5px;
        }
        
        .sections-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .card h2 {
            margin-bottom: 20px;
            color: #1a1a1a;
            font-size: 20px;
        }
        
        .job-list {
            list-style: none;
        }
        
        .job-item {
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        
        .job-item:hover {
            border-color: #000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .job-item h4 {
            margin-bottom: 8px;
            color: #1a1a1a;
        }
        
        .job-item p {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .job-meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #999;
        }
        
        .btn-apply {
            background: #000;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-item strong {
            color: #1a1a1a;
            font-size: 14px;
        }
        
        .activity-item span {
            color: #999;
            font-size: 13px;
            display: block;
            margin-top: 5px;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }
            
            .sections-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">WORKZY</div>
        <div class="nav">
            <a href="/">Home</a>
            <a href="#">Browse Jobs</a>
            <a href="#">My Proposals</a>
            <a href="#">Messages</a>
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="badge">Freelancer</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="welcome-card">
            <h1>Welcome back, {{ Auth::user()->name }}! 💼</h1>
            <p>Ready to take on new projects? Check out the latest job opportunities below.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Active Proposals</h3>
                <div class="number">0</div>
                <div class="change">📊 No change</div>
            </div>
            <div class="stat-card">
                <h3>Projects Completed</h3>
                <div class="number">0</div>
                <div class="change">✅ Get started!</div>
            </div>
            <div class="stat-card">
                <h3>Total Earnings</h3>
                <div class="number">$0</div>
                <div class="change">💰 Start earning</div>
            </div>
            <div class="stat-card">
                <h3>Messages</h3>
                <div class="number">0</div>
                <div class="change">💬 No new messages</div>
            </div>
        </div>

        <div class="sections-grid">
            <div class="card">
                <h2>🔍 Available Jobs</h2>
                <ul class="job-list">
                    <li class="job-item">
                        <h4>Website Design Project</h4>
                        <p>Looking for an experienced web designer to create a modern, responsive website...</p>
                        <div class="job-meta">
                            <span>💵 $500 - $1000</span>
                            <span>⏱️ Fixed Price</span>
                            <span>📅 Posted 2 hours ago</span>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </li>
                    <li class="job-item">
                        <h4>Mobile App Development</h4>
                        <p>Need a skilled developer for React Native mobile application development...</p>
                        <div class="job-meta">
                            <span>💵 $2000 - $3000</span>
                            <span>⏱️ Fixed Price</span>
                            <span>📅 Posted 5 hours ago</span>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </li>
                    <li class="job-item">
                        <h4>Content Writing for Blog</h4>
                        <p>Seeking a talented content writer for tech blog articles...</p>
                        <div class="job-meta">
                            <span>💵 $50 - $100</span>
                            <span>⏱️ Per Article</span>
                            <span>📅 Posted 1 day ago</span>
                        </div>
                        <button class="btn-apply">Apply Now</button>
                    </li>
                </ul>
            </div>

            <div class="card">
                <h2>📊 Recent Activity</h2>
                <ul class="activity-list">
                    <li class="activity-item">
                        <strong>Profile Created</strong>
                        <span>Welcome to WORKZY! Complete your profile to get started.</span>
                    </li>
                    <li class="activity-item">
                        <strong>Tip of the Day</strong>
                        <span>Add a professional photo to increase your chances of getting hired by 40%</span>
                    </li>
                    <li class="activity-item">
                        <strong>Next Steps</strong>
                        <span>Browse available jobs and submit your first proposal</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
