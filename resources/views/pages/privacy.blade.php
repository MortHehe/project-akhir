<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - WORKZY</title>
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
        <h1>Privacy Policy</h1>
        <p>Your privacy is important to us. Learn how we collect, use, and protect your data.</p>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="last-updated">
            <p>Last Updated: December 10, 2025</p>
        </div>

        <div class="section">
            <h2>1. Introduction</h2>
            <p>Welcome to WORKZY's Privacy Policy. This policy describes how we collect, use, disclose, and protect your personal information when you use our platform. By using WORKZY, you agree to the collection and use of information in accordance with this policy.</p>
        </div>

        <div class="section">
            <h2>2. Information We Collect</h2>

            <h3>2.1 Personal Information</h3>
            <p>When you register on WORKZY, we collect:</p>
            <ul>
                <li>Name and contact information (email address, phone number)</li>
                <li>Account credentials (username and password)</li>
                <li>Profile information (bio, skills, experience)</li>
                <li>Payment information (processed securely by third-party providers)</li>
                <li>Communication data (messages, reviews, ratings)</li>
            </ul>

            <h3>2.2 Automatically Collected Information</h3>
            <p>We automatically collect certain information when you use our platform:</p>
            <ul>
                <li>Device information (IP address, browser type, operating system)</li>
                <li>Usage data (pages visited, time spent, features used)</li>
                <li>Cookies and similar technologies</li>
                <li>Location data (if you grant permission)</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. How We Use Your Information</h2>
            <p>We use your information to:</p>
            <ul>
                <li>Provide and maintain our services</li>
                <li>Process transactions and send notifications</li>
                <li>Improve and personalize user experience</li>
                <li>Communicate with you about updates and promotions</li>
                <li>Detect and prevent fraud and abuse</li>
                <li>Comply with legal obligations</li>
                <li>Analyze platform usage and trends</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. Information Sharing and Disclosure</h2>

            <h3>4.1 With Other Users</h3>
            <p>When you create a profile on WORKZY, certain information becomes visible to other users, including your name, profile picture, skills, and work history.</p>

            <h3>4.2 With Service Providers</h3>
            <p>We may share your information with third-party service providers who perform services on our behalf, such as:</p>
            <ul>
                <li>Payment processing companies</li>
                <li>Email service providers</li>
                <li>Analytics providers</li>
                <li>Customer support tools</li>
            </ul>

            <h3>4.3 Legal Requirements</h3>
            <p>We may disclose your information if required by law or in response to valid requests by public authorities.</p>
        </div>

        <div class="section">
            <h2>5. Data Security</h2>
            <p>We implement appropriate technical and organizational measures to protect your personal information, including:</p>
            <ul>
                <li>Encryption of sensitive data</li>
                <li>Secure server infrastructure</li>
                <li>Regular security audits</li>
                <li>Access controls and authentication</li>
                <li>Employee training on data protection</li>
            </ul>
            <p>However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>
        </div>

        <div class="section">
            <h2>6. Your Rights and Choices</h2>
            <p>You have the right to:</p>
            <ul>
                <li><strong>Access:</strong> Request a copy of your personal data</li>
                <li><strong>Correction:</strong> Update or correct inaccurate information</li>
                <li><strong>Deletion:</strong> Request deletion of your account and data</li>
                <li><strong>Opt-out:</strong> Unsubscribe from marketing communications</li>
                <li><strong>Data Portability:</strong> Request transfer of your data</li>
                <li><strong>Object:</strong> Object to certain data processing activities</li>
            </ul>
            <p>To exercise these rights, please contact us at privacy@workzy.com</p>
        </div>

        <div class="section">
            <h2>7. Cookies and Tracking Technologies</h2>
            <p>We use cookies and similar technologies to enhance your experience, analyze usage, and deliver personalized content. You can control cookies through your browser settings, but disabling them may affect platform functionality.</p>
        </div>

        <div class="section">
            <h2>8. Data Retention</h2>
            <p>We retain your personal information for as long as necessary to fulfill the purposes outlined in this policy, unless a longer retention period is required by law. When you delete your account, we will remove your personal information within a reasonable timeframe.</p>
        </div>

        <div class="section">
            <h2>9. Children's Privacy</h2>
            <p>WORKZY is not intended for users under the age of 18. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.</p>
        </div>

        <div class="section">
            <h2>10. International Data Transfers</h2>
            <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your data in accordance with this policy.</p>
        </div>

        <div class="section">
            <h2>11. Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify you of any significant changes by email or through a prominent notice on our platform. Your continued use of WORKZY after changes become effective constitutes acceptance of the updated policy.</p>
        </div>

        <div class="section">
            <h2>12. Contact Us</h2>
            <p>If you have questions or concerns about this Privacy Policy, please contact us:</p>
            <p>
                <strong>Email:</strong> privacy@workzy.com<br>
                <strong>Phone:</strong> +1 (555) 123-4567<br>
                <strong>Address:</strong> 123 Business Street, San Francisco, CA 94102
            </p>
        </div>

        <div class="section">
            <p style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #f0f0f0; font-size: 14px; color: #999;">
                By using WORKZY, you acknowledge that you have read and understood this Privacy Policy and agree to its terms.
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
