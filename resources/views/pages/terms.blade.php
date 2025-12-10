<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - WORKZY</title>
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
            padding: 60px 60px;
            text-align: center;
            color: white;
        }

        .page-header h1 {
            font-size: 48px;
            margin-bottom: 16px;
            font-weight: 800;
        }

        .page-header p {
            font-size: 16px;
            opacity: 0.95;
        }

        /* Content Section */
        .content-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 40px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h2 {
            font-size: 28px;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .section h3 {
            font-size: 20px;
            margin-bottom: 12px;
            margin-top: 24px;
            color: #333;
        }

        .section p {
            font-size: 15px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .section ul {
            margin-left: 24px;
            margin-bottom: 16px;
        }

        .section ul li {
            font-size: 15px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 8px;
        }

        .last-updated {
            background: #f8f9ff;
            border-left: 4px solid #667eea;
            padding: 16px 20px;
            margin-bottom: 40px;
            border-radius: 4px;
        }

        .last-updated p {
            margin: 0;
            color: #667eea;
            font-weight: 600;
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
            .header, .page-header, .content-section, .footer {
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
        <h1>Terms of Service</h1>
        <p>Please read these terms carefully before using our platform</p>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="last-updated">
            <p>Last Updated: December 10, 2025</p>
        </div>

        <div class="section">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using WORKZY ("the Platform"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to these Terms of Service, please do not use the Platform.</p>
        </div>

        <div class="section">
            <h2>2. Description of Service</h2>
            <p>WORKZY provides an online platform that connects clients with freelancers for various services including but not limited to:</p>
            <ul>
                <li>Web development and programming</li>
                <li>Graphic design and creative services</li>
                <li>Content writing and copywriting</li>
                <li>Digital marketing and SEO</li>
                <li>Mobile app development</li>
                <li>Other professional services</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. User Accounts</h2>
            <h3>3.1 Registration</h3>
            <p>To use certain features of the Platform, you must register for an account. You agree to:</p>
            <ul>
                <li>Provide accurate, current, and complete information</li>
                <li>Maintain and update your information to keep it accurate</li>
                <li>Maintain the security of your password</li>
                <li>Accept responsibility for all activities under your account</li>
            </ul>

            <h3>3.2 Account Types</h3>
            <p>WORKZY offers two types of accounts:</p>
            <ul>
                <li><strong>Client Accounts:</strong> For users seeking to hire freelancers</li>
                <li><strong>Freelancer Accounts:</strong> For professionals offering services</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. User Conduct</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Use the Platform for any illegal purposes</li>
                <li>Post false, misleading, or fraudulent content</li>
                <li>Harass, abuse, or harm other users</li>
                <li>Attempt to bypass payment systems</li>
                <li>Share your account credentials with others</li>
                <li>Engage in any activity that disrupts the Platform</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. Payment Terms</h2>
            <h3>5.1 For Clients</h3>
            <p>Clients agree to pay for services as specified in project agreements. All payments are processed securely through the Platform.</p>

            <h3>5.2 For Freelancers</h3>
            <p>Freelancers will receive payment upon successful completion of work and client approval. WORKZY may charge a service fee on transactions.</p>

            <h3>5.3 Refunds</h3>
            <p>Refund policies are determined on a case-by-case basis. Please contact support for refund requests.</p>
        </div>

        <div class="section">
            <h2>6. Intellectual Property</h2>
            <p>All content on WORKZY, including text, graphics, logos, and software, is the property of WORKZY or its content suppliers and protected by intellectual property laws.</p>
            <p>Work products created by freelancers for clients become the property of the client upon full payment, unless otherwise agreed in writing.</p>
        </div>

        <div class="section">
            <h2>7. Dispute Resolution</h2>
            <p>If disputes arise between users, we encourage resolution through our messaging system. WORKZY may provide mediation services but is not obligated to resolve disputes between users.</p>
        </div>

        <div class="section">
            <h2>8. Limitation of Liability</h2>
            <p>WORKZY is not liable for:</p>
            <ul>
                <li>The quality or delivery of services between users</li>
                <li>Any indirect, incidental, or consequential damages</li>
                <li>Loss of profits or data</li>
                <li>Actions or omissions of other users</li>
            </ul>
        </div>

        <div class="section">
            <h2>9. Termination</h2>
            <p>We reserve the right to terminate or suspend accounts that violate these Terms of Service without prior notice. Users may also terminate their accounts at any time through account settings.</p>
        </div>

        <div class="section">
            <h2>10. Changes to Terms</h2>
            <p>WORKZY reserves the right to modify these Terms of Service at any time. Users will be notified of significant changes via email or platform notifications.</p>
        </div>

        <div class="section">
            <h2>11. Contact Information</h2>
            <p>For questions about these Terms of Service, please contact us at:</p>
            <p>Email: legal@workzy.com<br>Phone: +1 (555) 123-4567</p>
        </div>

        <div class="section">
            <p style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #f0f0f0; font-size: 14px; color: #999;">
                By using WORKZY, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
            </p>
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
