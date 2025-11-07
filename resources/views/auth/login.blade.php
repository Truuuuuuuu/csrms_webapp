<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>Login - SRMS</title>
    
</head>
<body>
    <div class="container">
        <!-- Left side with logo -->
        <div class="left">
            <img src="{{ asset('images/logo.png') }}" alt="SRMS Logo">
        </div>

        <!-- Right side with login form -->
        <div class="right">
            <div class="login-box">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
