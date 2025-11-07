<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login - SRMS</title>
</head>

<body>
    <div class="login-page">

        <!-- Left side: Logo -->
        <div class="left-side">
            <img src="{{ asset('images/sys-logo.png') }}" alt="SRMS Logo">
        </div>

        <!-- Right side: Login form container -->
        <div class="right-side">
            <div class="login-container">
                <h2 class="title">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <button type="submit">Sign In</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>