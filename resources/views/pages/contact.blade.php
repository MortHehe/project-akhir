<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - WORKZY</title>
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

        /* Contact Section */
        .contact-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .contact-info h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .contact-info p {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 30px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .contact-item-content h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #1a1a1a;
        }

        .contact-item-content p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        /* Contact Form */
        .contact-form {
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .contact-form h3 {
            font-size: 24px;
            margin-bottom: 30px;
            color: #1a1a1a;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
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

        @media (max-width: 968px) {
            .contact-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        @media (max-width: 768px) {
            .header, .page-header, .contact-section, .footer {
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
        <h1>Contact Us</h1>
        <p>Have a question or need help? We're here to assist you. Reach out to us and we'll get back to you as soon as possible.</p>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p>Whether you have a question about features, pricing, need a demo, or anything else, our team is ready to answer all your questions.</p>

            <div class="contact-item">
                <div class="contact-icon">📧</div>
                <div class="contact-item-content">
                    <h3>Email</h3>
                    <p>support@workzy.com</p>
                    <p>We'll respond within 24 hours</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">📱</div>
                <div class="contact-item-content">
                    <h3>Phone</h3>
                    <p>+1 (555) 123-4567</p>
                    <p>Mon-Fri from 8am to 6pm</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">🏢</div>
                <div class="contact-item-content">
                    <h3>Office</h3>
                    <p>123 Business Street</p>
                    <p>San Francisco, CA 94102</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">💬</div>
                <div class="contact-item-content">
                    <h3>Live Chat</h3>
                    <p>Available 24/7 for members</p>
                    <p>Sign in to start chatting</p>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h3>Send us a Message</h3>
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Your Name *</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" placeholder="john@example.com" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <select id="subject" name="subject" required>
                        <option value="">Choose a subject</option>
                        <option value="general">General Inquiry</option>
                        <option value="support">Technical Support</option>
                        <option value="billing">Billing Question</option>
                        <option value="partnership">Partnership</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" placeholder="Tell us how we can help you..." required></textarea>
                </div>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>
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
