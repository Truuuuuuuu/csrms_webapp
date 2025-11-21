<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @auth
        @if(in_array(auth()->user()->role, ['admin', 'editor', 'viewer']))
            <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        @endif
        @if(auth()->user()->role === 'admin')
            <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
        @endif
    @endauth

    @stack('styles')

</head>

<body>

    <div class="d-flex">

        {{-- Sidebar based on user role --}}
        @auth
            @if(auth()->user()->role === 'admin')
                @include('layouts.sidebars.sidebar_admin')
            @elseif(auth()->user()->role === 'editor')
                @include('layouts.sidebars.sidebar_editor')
            @elseif(auth()->user()->role === 'viewer')
                @include('layouts.sidebars.sidebar_viewer')
            @endif
        @endauth

        {{-- Main content --}}
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>

<script src="{{ asset('js/logout.js') }}"></script>
