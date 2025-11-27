<div class="user-info-card d-flex align-items-center">

    <div class="d-flex align-items-center">
        <div class="user-avatar role-avatar {{ auth()->user()->role }}">
            {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
        </div>

        <div class="user-details ms-3">
            <h2>Welcome, {{ $currentUsername }}</h2>
            <p class="user-role">{{ ucfirst(auth()->user()->role) }}</p>
        </div>
    </div>

    {{-- Logout button container --}}
    <div class="sidebar-logout">
        <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); confirmLogout();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</div>
