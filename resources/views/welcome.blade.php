<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORKZY - Find Top Freelancers & Build Your Dream Team</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff;
            color: #1a1a1a;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        .nav {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .nav a {
            color: #333;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            padding: 12px 28px;
            border: 2px solid #667eea;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 100px 60px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,165.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            opacity: 0.3;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 56px;
            margin-bottom: 24px;
            line-height: 1.2;
            font-weight: 800;
            text-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.95;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn-hero {
            padding: 16px 40px;
            font-size: 16px;
            border-radius: 10px;
        }

        .btn-white {
            background: white;
            color: #667eea;
            font-weight: 700;
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,255,255,0.3);
        }

        /* Search Section */
        .search-section {
            padding: 60px 60px;
            background: #f8f9ff;
        }

        .search-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .search-container h2 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #1a1a1a;
        }

        .search-bar {
            display: flex;
            background: white;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .search-bar input {
            flex: 1;
            border: none;
            padding: 18px 24px;
            font-size: 16px;
            outline: none;
            border-radius: 8px;
        }

        .search-bar button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 16px;
            transition: transform 0.3s;
        }

        .search-bar button:hover {
            transform: scale(1.05);
        }

        /* Categories Section */
        .categories-section {
            padding: 80px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 40px;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .section-header p {
            font-size: 18px;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .category-card {
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            border-color: #667eea;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.15);
            transform: translateY(-8px);
        }

        .category-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .category-card h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .category-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .category-card .btn-order {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: transform 0.3s;
        }

        .category-card .btn-order:hover {
            transform: scale(1.05);
        }

        /* Freelancer Section */
        .freelancer-section {
            background: linear-gradient(180deg, #f8f9ff 0%, #ffffff 100%);
            padding: 80px 60px;
        }

        .freelancers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .freelancer-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }

        .freelancer-card:hover {
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
            transform: translateY(-8px);
        }

        .freelancer-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 120px;
            position: relative;
        }

        .freelancer-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
            border: 5px solid white;
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 700;
            color: white;
        }

        .freelancer-info {
            padding: 60px 25px 25px;
            text-align: center;
        }

        .freelancer-info h3 {
            font-size: 22px;
            margin-bottom: 8px;
            color: #1a1a1a;
        }

        .freelancer-title {
            color: #667eea;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .freelancer-location {
            color: #999;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .freelancer-stats {
            display: flex;
            justify-content: space-around;
            padding: 16px 0;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 20px;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
        }

        .stat-label {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        .freelancer-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .skill-tag {
            background: #f0f0ff;
            color: #667eea;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .freelancer-actions {
            display: flex;
            gap: 10px;
        }

        .btn-contact, .btn-hire {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .btn-contact {
            background: #f0f0f0;
            color: #333;
        }

        .btn-contact:hover {
            background: #e0e0e0;
        }

        .btn-hire {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-hire:hover {
            transform: scale(1.05);
        }

        /* How It Works Section */
        .how-it-works {
            padding: 80px 60px;
            background: white;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .step-card {
            text-align: center;
            padding: 30px 20px;
        }

        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .step-card h3 {
            font-size: 20px;
            margin-bottom: 12px;
        }

        .step-card p {
            color: #666;
            font-size: 14px;
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 60px 30px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 50px;
            margin-bottom: 40px;
        }

        .footer-section h4 {
            margin-bottom: 24px;
            font-size: 18px;
        }

        .footer-brand {
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-section p {
            color: #aaa;
            line-height: 1.8;
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
            color: #667eea;
        }

        .footer-bottom {
            padding-top: 30px;
            border-top: 1px solid #333;
            text-align: center;
            color: #aaa;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header, .hero, .search-section, .categories-section, .freelancer-section, .how-it-works, .footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo" onclick="window.location='{{ route('home') }}'" style="cursor: pointer;">⚫ WORKZY</div>
        <div class="nav">
            <a href="/">Explore</a>
            <a href="{{ route('find-freelancers') }}">Find Freelancers</a>
            <a href="{{ route('freelancer.register.form') }}">Become A Freelancer</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
                <a href="{{ route('register') }}" class="btn-primary">Sign Up</a>
            @endauth
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Find Top Freelancers & Build Your Dream Team</h1>
            <p>Connect with talented professionals worldwide or start your freelancing journey today. Quality work, delivered on time.</p>
            <div class="hero-buttons">
                <a href="{{ route('find-freelancers') }}" class="btn-primary btn-hero btn-white">Browse Freelancers</a>
                <a href="{{ route('freelancer.register.form') }}" class="btn-secondary btn-hero">Start Freelancing</a>
            </div>
        </div>
    </section>

    <!-- Search Bar -->
    <section class="search-section">
        <div class="search-container">
            <h2>What service are you looking for?</h2>
            <form action="{{ route('find-freelancers') }}" method="GET">
                <div class="search-bar">
                    <input type="text" name="search" placeholder="Try 'Web Development', 'Logo Design', 'Content Writing'...">
                    <button type="submit">🔍 Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Categories Section -->
    <div class="categories-section">
        <div class="section-header">
            <h2>Popular Services</h2>
            <p>Browse our most requested services and find the perfect freelancer for your project</p>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-icon">💻</div>
                <h3>Web Development</h3>
                <p>Full-stack, Frontend, Backend developers ready to build your website</p>
                <button class="btn-order" onclick="window.location='{{ route('find-freelancers') }}?skill=Web Development'">Browse Developers</button>
            </div>
            <div class="category-card">
                <div class="category-icon">🎨</div>
                <h3>Graphic Design</h3>
                <p>Logo, branding, UI/UX design by creative professionals</p>
                <button class="btn-order" onclick="window.location='{{ route('find-freelancers') }}?skill=Graphic Design'">Find Designers</button>
            </div>
            <div class="category-card">
                <div class="category-icon">✍️</div>
                <h3>Content Writing</h3>
                <p>SEO content, copywriting, technical writing experts</p>
                <button class="btn-order" onclick="window.location='{{ route('find-freelancers') }}?skill=Content Writing'">Hire Writers</button>
            </div>
            <div class="category-card">
                <div class="category-icon">📱</div>
                <h3>Mobile Apps</h3>
                <p>iOS, Android app development by experienced developers</p>
                <button class="btn-order" onclick="window.location='{{ route('find-freelancers') }}?skill=Mobile Development'">Get Started</button>
            </div>
        </div>
    </div>

    <!-- Top Freelancers Section -->
    <section class="freelancer-section">
        <div class="section-header">
            <h2>Top Rated Freelancers</h2>
            <p>Meet our most talented and highly-rated professionals</p>
        </div>

        <div class="freelancers-grid">
            @php
                // Try to get top rated freelancers with reviews
                $topFreelancers = App\Models\User::where('role', 'freelancer')
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->having('reviews_count', '>', 0)
                    ->orderByDesc('reviews_avg_rating')
                    ->orderByDesc('reviews_count')
                    ->take(3)
                    ->get();

                // Fallback: if no freelancers with reviews, get latest freelancers
                if ($topFreelancers->isEmpty()) {
                    $topFreelancers = App\Models\User::where('role', 'freelancer')
                        ->latest()
                        ->take(3)
                        ->get();
                }
            @endphp

            @forelse($topFreelancers as $freelancer)
                <div class="freelancer-card">
                    <div class="freelancer-header">
                        <div class="freelancer-avatar">
                            {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="freelancer-info">
                        <h3>{{ $freelancer->name }}</h3>
                        <div class="freelancer-title">{{ $freelancer->title ?? 'Professional Freelancer' }}</div>
                        <div class="freelancer-location">📍 {{ $freelancer->location ?? 'Remote' }}</div>

                        <div class="freelancer-stats">
                            <div class="stat">
                                <div class="stat-value">{{ number_format($freelancer->getAverageRatingAttribute(), 1) }}</div>
                                <div class="stat-label">Rating</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">{{ $freelancer->freelancerOrders()->where('status', 'completed')->count() }}</div>
                                <div class="stat-label">Projects</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">{{ $freelancer->getTotalReviewsAttribute() }}</div>
                                <div class="stat-label">Reviews</div>
                            </div>
                        </div>

                        @php
                            $skills = is_string($freelancer->skills) ? json_decode($freelancer->skills, true) : ($freelancer->skills ?? ['Freelancer']);
                            if (!is_array($skills)) $skills = ['Freelancer'];
                        @endphp

                        <div class="freelancer-skills">
                            @foreach(array_slice($skills, 0, 3) as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                        </div>

                        <div class="freelancer-actions">
                            @auth
                                <button class="btn-contact" onclick="window.location='{{ route('chat.show', $freelancer->id) }}'">Message</button>
                                <button class="btn-hire" onclick="window.location='{{ route('orders.create') }}?freelancer_id={{ $freelancer->id }}'">Hire Now</button>
                            @else
                                <button class="btn-contact" onclick="window.location='{{ route('login') }}'">Message</button>
                                <button class="btn-hire" onclick="window.location='{{ route('login') }}'">Hire Now</button>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                    <h3>No freelancers available yet</h3>
                    <p>Be the first to join as a freelancer!</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="section-header">
            <h2>How It Works</h2>
            <p>Get started in just a few simple steps</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Post Your Job</h3>
                <p>Describe your project requirements and budget</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Find Freelancers</h3>
                <p>Browse profiles and hire the perfect match</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Collaborate</h3>
                <p>Work together using our messaging system</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3>Pay Securely</h3>
                <p>Release payment when you're satisfied</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-brand">⚫ WORKZY</div>
                <p>Your trusted platform for finding top freelancers and building amazing projects. Connect, collaborate, and create.</p>
            </div>
            <div class="footer-section">
                <h4>For Clients</h4>
                <ul>
                    <li><a href="{{ route('find-freelancers') }}">Find Freelancers</a></li>
                    <li><a href="{{ route('orders.create') }}">Post a Job</a></li>
                    <li><a href="#">How it Works</a></li>
                    <li><a href="#">Success Stories</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>For Freelancers</h4>
                <ul>
                    <li><a href="{{ route('freelancer.register.form') }}">Become a Freelancer</a></li>
                    <li><a href="#">Find Jobs</a></li>
                    <li><a href="#">Resources</a></li>
                    <li><a href="#">Community</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 WORKZY. All rights reserved. Made with ❤️ for freelancers worldwide.</p>
        </div>
    </footer>
</body>
</html>
