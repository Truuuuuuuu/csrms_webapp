<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-page d-flex">
        <!-- Left Image -->
        <div class="login-image d-none d-md-block"></div>

        <!-- Right Form -->
        <div class="login-form d-flex align-items-center justify-content-center">
            <div class="form-wrapper w-75">
                <h1 class="text-center mb-4">CSRMS</h1>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login.post') }}">
                    @csrf
                    @error('credentials')
                        <div class="wrong-credentials">{{ $message }}</div>
                    @enderror

                    @error('password')
                        <div class="wrong-password">{{ $message }}</div>
                    @enderror

                    <div class="floating-label">
                        <input type="text" name="username" id="username" class="username-field" placeholder=" " required>
                        <label for="username">Username</label>
                    </div>

                    <div class="floating-label">
                        <input type="password" name="password" id="password" class="password-field" placeholder=" " required>
                        <label for="password">Password</label>
                    </div>


                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prevent back navigation to protected pages after logout
        if (window.history && window.history.pushState) {
            // Replace current history entry to prevent back navigation
            window.history.replaceState(null, null, window.location.href);
            window.addEventListener('popstate', function(event) {
                // If user tries to go back, replace with current page
                window.history.replaceState(null, null, window.location.href);
            });
        }
    </script>
</body>

</html>