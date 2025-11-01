<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Freelancer - WORKZY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        }
        
        .btn-signin {
            background: #000;
            color: white;
            padding: 10px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }
        
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        
        .register-card {
            background: white;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        
        .register-card h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 10px;
            color: #1a1a1a;
        }
        
        .register-card .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 15px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
        }
        
        .form-group input.error {
            border-color: #e74c3c;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        .checkbox-group input[type="checkbox"] {
            margin-top: 3px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .checkbox-group label {
            font-size: 14px;
            color: #555;
            cursor: pointer;
        }
        
        .btn-register {
            width: 100%;
            padding: 16px;
            background: #000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }
        
        .login-link a {
            color: #000;
            font-weight: 600;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            
            .register-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">WORKZY</div>
        <div class="nav">
            <a href="/">Explore</a>
            <a href="#">Find Freelancer</a>
            <a href="/register">Become A Client</a>
            <a href="/login" class="btn-signin">Sign in</a>
        </div>
    </div>

    <div class="container">
        <div class="register-card">
            <h1>Register as Freelancer</h1>
            <p class="subtitle">Join our community of talented freelancers</p>
            
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('freelancer.register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        class="@error('name') error @enderror"
                        required
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        class="@error('email') error @enderror"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="Enter your password (min. 8 characters)"
                        class="@error('password') error @enderror"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="skills">Skills (Optional)</label>
                    <textarea 
                        id="skills" 
                        name="skills"
                        placeholder="e.g., Web Development, Graphic Design, Content Writing..."
                    >{{ old('skills') }}</textarea>
                </div>
                
                <div class="checkbox-group">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        name="terms" 
                        value="1"
                        required
                    >
                    <label for="terms">
                        <strong>I agree to the terms and conditions</strong> as a freelancer
                    </label>
                </div>
                @error('terms')
                    <div class="error-message" style="margin-top: -20px; margin-bottom: 20px;">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="btn-register">Register as Freelancer</button>
                
                <div class="login-link">
                    Already have an account? <a href="/login">Sign in</a><br>
                    Want to be a client? <a href="/register">Register as Client</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
