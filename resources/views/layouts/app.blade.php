<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @auth
        @if(in_array(auth()->user()->role, ['superadmin', 'admin', 'editor', 'viewer']))
            <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        @endif
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
            <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
        @endif
        @if(in_array(auth()->user()->role, ['superadmin', 'admin', 'editor', 'viewer']))
            <link rel="stylesheet" href="{{ asset('css/user_info_card.css') }}">
        @endif
    @endauth

    @stack('styles')

</head>

<body>

    <div class="d-flex">

        {{-- Sidebar access on all user role --}}
        @auth
            @include('layouts.sidebars.sidebar')
        @endauth


        {{-- Main content --}}
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Prevent browser from caching authenticated pages
        if (window.history && window.history.pushState) {
            // Clear any cached pages when navigating
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    // Page was loaded from cache, reload it
                    window.location.reload();
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>

<script src="{{ asset('js/logout.js') }}"></script>