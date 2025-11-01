<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WORKZY</title>
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
        
        /* Header */
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
        
        .nav a:hover {
            color: #000;
        }
        
        .btn-signin {
            background: #000;
            color: white;
            padding: 10px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }
        
        .btn-dashboard {
            background: white;
            color: #000;
            padding: 10px 25px;
            border: 2px solid #000;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }
        
        /* Main Content */
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
            max-width: 450px;
        }
        
        .register-card h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 40px;
            color: #1a1a1a;
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
        .form-group input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus {
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
        
        .checkbox-group .helper-text {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
            display: block;
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
        
        .btn-register:active {
            transform: translateY(0);
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
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            
            .logo {
                font-size: 24px;
            }
            
            .nav {
                gap: 15px;
            }
            
            .register-card {
                padding: 30px 25px;
            }
            
            .register-card h1 {
                font-size: 28px;
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
            <a href="/login" class="btn-signin">Sign in</a>
            <a href="/login" class="btn-dashboard">Dashboard</a>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="container">
        <div class="register-card">
            <h1>Register User</h1>
            
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Enter your name"
                        class="@error('name') error @enderror"
                        required
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Email -->
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
                
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="Enter your password"
                        class="@error('password') error @enderror"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Password Confirmation -->
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
                
                <!-- Terms Checkbox -->
                <div class="checkbox-group">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        name="terms" 
                        value="1"
                        required
                    >
                    <label for="terms">
                        <strong>I agree to the terms and conditions</strong>
                        <span class="helper-text">By registering, you accept our terms and conditions</span>
                    </label>
                </div>
                @error('terms')
                    <div class="error-message" style="margin-top: -20px; margin-bottom: 20px;">{{ $message }}</div>
                @enderror
                
                <!-- Submit Button -->
                <button type="submit" class="btn-register">Register</button>
                
                <!-- Login Link -->
                <div class="login-link">
                    Already have an account? <a href="/login">Sign in</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>