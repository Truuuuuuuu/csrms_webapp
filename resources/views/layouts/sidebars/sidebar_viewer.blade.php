<nav class="sidebar">
    <div class="sidebar-header">
        <h2>CSRMS</h2>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('viewer.dashboard') }}"
                class="{{ request()->routeIs('viewer.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i> Student Records
            </a>
        </li>

        <li>
            <a href="{{ route('profile.index') }}" 
               class="{{ request()->routeIs('profile*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profile
            </a>
        </li>
    </ul>

    {{-- Logout at bottom --}}
    <div class="sidebar-logout mt-auto px-3">
        <a href="{{ route('logout') }}" class="btn btn-danger w-100" onclick="event.preventDefault(); confirmLogout();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>

