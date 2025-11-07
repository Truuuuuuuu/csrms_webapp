<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>CSRMS Dashboard</title>

</head>

<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <!-- Top section: avatar, name, title, and nav links -->
        <div class="sidebar-top">
            <div class="user-profile">
                <img src="{{ asset('images/sys-logo.png') }}" alt="User Avatar">
                <div class="user-name">{{ Auth::user()->name }}</div>
            </div>

            <nav>
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="#">Accounts</a>
                <a href="#">Student Records</a>
            </nav>
        </div>

        <!-- Bottom section: logout -->
        <div class="sidebar-bottom">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>


    <!-- Main content -->
    <div class="main-content">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p>This is your dashboard. Add cards, tables, charts, or any content here.</p>
    </div>
</body>

</html>