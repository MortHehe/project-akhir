<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORKZY - Find Freelancers & Jobs</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        /* Header */
        .header {
            background: white;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: -1px;
        }
        
        .nav {
            display: flex;
            gap: 40px;
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
        
        .btn-signin {
            background: #000;
            color: white;
            padding: 10px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-signin:hover {
            background: #333;
        }
        
        .btn-dashboard {
            background: white;
            color: #000;
            padding: 10px 30px;
            border: 2px solid #000;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-dashboard:hover {
            background: #000;
            color: white;
        }
        
        /* Hero Section */
        .hero {
            background: white;
            padding: 60px 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero-content p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }
        
        .btn-learn {
            display: inline-block;
            color: #000;
            font-weight: 600;
            text-decoration: none;
            font-size: 16px;
        }
        
        .hero-image {
            background: #000;
            height: 400px;
            border-radius: 12px;
        }
        
        /* Search Bar */
        .search-section {
            padding: 40px 50px;
            background: #f0f0f0;
        }
        
        .search-bar {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            background: white;
            border-radius: 8px;
            padding: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .search-bar input {
            flex: 1;
            border: none;
            padding: 15px 20px;
            font-size: 16px;
            outline: none;
        }
        
        .search-bar button {
            background: #000;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        
        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 50px;
        }
        
        .section-title {
            font-size: 32px;
            margin-bottom: 40px;
            text-align: center;
        }
        
        /* Job Cards */
        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 80px;
        }
        
        .job-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .job-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        
        .job-card h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .job-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .btn-order {
            background: white;
            border: 2px solid #000;
            color: #000;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-order:hover {
            background: #000;
            color: white;
        }
        
        /* Freelancer Section */
        .value-section {
            background: white;
            padding: 80px 50px;
            text-align: center;
        }
        
        .value-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        
        .value-section p {
            color: #666;
            font-size: 18px;
            margin-bottom: 60px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .freelancer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .freelancer-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .freelancer-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            transform: translateY(-5px);
        }
        
        .freelancer-image {
            background: #000;
            height: 250px;
            width: 100%;
        }
        
        .freelancer-info {
            padding: 25px;
        }
        
        .freelancer-info h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .freelancer-info a {
            color: #000;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }
        
        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 50px;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            text-align: left;
        }
        
        .footer-section h4 {
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 12px;
        }
        
        .footer-section a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: white;
        }
        
        .footer-bottom {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #333;
            text-align: center;
            color: #aaa;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            
            .hero {
                grid-template-columns: 1fr;
                padding: 40px 20px;
            }
            
            .hero-content h1 {
                font-size: 36px;
            }
            
            .container {
                padding: 40px 20px;
            }
            
            .job-grid {
                grid-template-columns: 1fr;
            }
            
            .freelancer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">WORKZY</div>
        <div class="nav">
            <a href="/">Explore</a>
            <a href="#">Find Freelancer</a>
            <a href="register/freelancer">Become A freelancer</a>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="/admin" class="btn-dashboard">Admin Panel</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="btn-dashboard">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-signin" style="cursor: pointer;">Logout</button>
                </form>
            @else
                <a href="/login" class="btn-signin">Sign in</a>
                <a href="/register" class="btn-dashboard">Sign up</a>
            @endauth
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Meet Our Best Freelancer or Became a Freelancer For Making money</h1>
            <p>Connect with talented freelancers or start your freelancing journey today.</p>
            <a href="#" class="btn-learn">Learn More →</a>
        </div>
        <div class="hero-image"></div>
    </section>

    <!-- Search Bar -->
    <section class="search-section">
        <div class="search-bar">
            <input type="text" placeholder="Search Job What U need">
            <button>🔍</button>
        </div>
    </section>

    <!-- Job Cards Section -->
    <div class="container">
        <div class="job-grid">
            <div class="job-card">
                <h3>JOB TITTLE</h3>
                <p>Job Description</p>
                <button class="btn-order">Order Now</button>
            </div>
            <div class="job-card">
                <h3>JOB TITTLE</h3>
                <p>Job Description</p>
                <button class="btn-order">Order Now</button>
            </div>
            <div class="job-card">
                <h3>JOB TITTLE</h3>
                <p>Job Description</p>
                <button class="btn-order">Order Now</button>
            </div>
            <div class="job-card">
                <h3>JOB TITTLE</h3>
                <p>Job Description</p>
                <button class="btn-order">Order Now</button>
            </div>
            <div class="job-card">
                <h3>JOB TITTLE</h3>
                <p>Job Description</p>
                <button class="btn-order">Order Now</button>
            </div>
        </div>
    </div>

    <!-- Freelancer Value Section -->
    <section class="value-section">
        <h2>Your Best Value Freelancer</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
        
        <div class="freelancer-grid">
            <div class="freelancer-card">
                <div class="freelancer-image"></div>
                <div class="freelancer-info">
                    <h3>Meet Our Best Freelancer or Became a Freelancer For Making money</h3>
                    <a href="#">Learn More →</a>
                </div>
            </div>
            <div class="freelancer-card">
                <div class="freelancer-image"></div>
                <div class="freelancer-info">
                    <h3>Meet Our Best Freelancer or Became a Freelancer For Making money</h3>
                    <a href="#">Learn More →</a>
                </div>
            </div>
            <div class="freelancer-card">
                <div class="freelancer-image"></div>
                <div class="freelancer-info">
                    <h3>Meet Our Best Freelancer or Became a Freelancer For Making money</h3>
                    <a href="#">Learn More →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>WORKZY</h4>
                <p style="color: #aaa;">Your trusted platform for finding freelancers and jobs.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>For Clients</h4>
                <ul>
                    <li><a href="#">Find Freelancers</a></li>
                    <li><a href="#">Post a Job</a></li>
                    <li><a href="#">How it Works</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>For Freelancers</h4>
                <ul>
                    <li><a href="#">Find Jobs</a></li>
                    <li><a href="#">Become a Freelancer</a></li>
                    <li><a href="#">Success Stories</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 WORKZY. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>