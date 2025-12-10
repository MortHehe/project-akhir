<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - WORKZY</title>
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
            cursor: pointer;
            transition: transform 0.3s;
        }

        .logo:hover {
            transform: scale(1.05);
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
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 60px;
            text-align: center;
            color: white;
        }

        .page-header h1 {
            font-size: 48px;
            margin-bottom: 16px;
            font-weight: 800;
        }

        .page-header p {
            font-size: 18px;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Content Section */
        .content-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 60px;
        }

        .section {
            margin-bottom: 60px;
        }

        .section h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .section p {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        /* Values Grid */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .value-card {
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            border-color: #667eea;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.15);
            transform: translateY(-5px);
        }

        .value-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .value-card h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .value-card p {
            color: #666;
            font-size: 14px;
        }

        /* Team Section */
        .team-section {
            background: #f8f9ff;
            padding: 80px 60px;
        }

        .team-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .team-container h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
            color: #1a1a1a;
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
            .header, .page-header, .content-section, .team-section, .footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .page-header h1 {
                font-size: 32px;
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
        <div class="logo" onclick="window.location='{{ route('home') }}'">⚫ WORKZY</div>
        <div class="nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('find-freelancers') }}">Find Freelancers</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary">Sign In</a>
            @endauth
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1>About WORKZY</h1>
        <p>Connecting talented freelancers with clients worldwide. Building the future of work, one project at a time.</p>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="section">
            <h2>Our Story</h2>
            <p>WORKZY was founded with a simple mission: to make freelancing accessible, secure, and rewarding for everyone. We believe that talented professionals should be able to work from anywhere, and businesses should have access to the best talent globally.</p>
            <p>Since our launch, we've helped thousands of freelancers find meaningful work and enabled businesses to build their dream teams. Our platform combines cutting-edge technology with a human touch to create the ultimate freelancing experience.</p>
        </div>

        <div class="section">
            <h2>Our Mission</h2>
            <p>We're on a mission to empower freelancers and businesses to achieve their goals through meaningful collaboration. We strive to create a platform where quality work meets fair compensation, where trust is built through transparency, and where everyone can thrive.</p>
        </div>

        <div class="section">
            <h2>Our Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">🎯</div>
                    <h3>Quality First</h3>
                    <p>We prioritize quality in every interaction, ensuring the best experience for both freelancers and clients.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Trust & Transparency</h3>
                    <p>We build trust through transparent processes, clear communication, and fair practices.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🚀</div>
                    <h3>Innovation</h3>
                    <p>We continuously innovate to provide better tools and features for our community.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💼</div>
                    <h3>Professional Growth</h3>
                    <p>We support the growth and development of every freelancer on our platform.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌍</div>
                    <h3>Global Community</h3>
                    <p>We connect people across borders, creating a truly global freelance marketplace.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">⚡</div>
                    <h3>Speed & Efficiency</h3>
                    <p>We make hiring and getting hired fast, simple, and efficient for everyone.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="team-section">
        <div class="team-container">
            <h2>Join Our Growing Community</h2>
            <div style="text-align: center; padding: 40px; color: #666;">
                <p style="font-size: 18px; margin-bottom: 30px;">Whether you're a freelancer looking for your next opportunity or a business seeking top talent, WORKZY is here to help you succeed.</p>
                <a href="{{ route('register') }}" class="btn-primary" style="display: inline-block; padding: 16px 40px; font-size: 16px;">Get Started Today</a>
            </div>
        </div>
    </div>

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
