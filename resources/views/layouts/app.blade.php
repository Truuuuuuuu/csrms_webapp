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

    <link rel="preload" href="{{ asset('images/csrms_w.png') }}" as="image">
    <link rel="icon" type="image/png" sizes="40x40" href="{{ asset('images/favicon.png') }}">



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

    <link rel="stylesheet" href="{{ asset('css/show_records.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fab_addfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student_records_component.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_all_users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student_records.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student_records_dashb.css') }}">
    <link rel="stylesheet" href="{{ asset('css/constant.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}">



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
        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                document.getElementById('sidebar-logout-form').submit();
            }
        }
    </script>
    @stack('scripts')
</body>

</html>

<script src="{{ asset('js/logout.js') }}"></script>

<script src="{{ asset('js/fab_addfile.js') }}"></script>

<script src="{{ asset('js/success_banner.js') }}"></script>

<script src="{{ asset('js/conf_del.js') }}"></script>