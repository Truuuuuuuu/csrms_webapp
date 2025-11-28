@php
    $dashboardRoute = match (auth()->user()->role) {
        'superadmin', 'admin' => 'admin.dashboard',
        'editor' => 'editor.dashboard',
        'viewer' => 'viewer.dashboard',
        default => 'dashboard',
    };
@endphp

<nav class="sidebar">
    <div class="sidebar-header">
        <h2>CSRMS</h2>
    </div>

    <ul class="sidebar-menu">
        <!-- DASHBOARD -->
        <li>
            <a href="{{ route($dashboardRoute) }}" class="{{ request()->routeIs($dashboardRoute) ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <!-- STUDENT RECORDS -->
        <li>
            <a href="{{ route('student.records') }}"
                class="{{ request()->routeIs('student.records', 'student_records.show') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i> Student Records
            </a>
        </li>

        <!-- ALL USERS -->
        @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> All Users
                </a>
            </li>
        @endif

        <!-- PROFILE -->
        <li>
            <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Account
            </a>
        </li>


    </ul>

    {{-- Logout button container --}}
    <div class="sidebar-logout text-center">
        <a href="{{ route('logout') }}" class="btn btn-danger sidebar-logout-btn"
            onclick="event.preventDefault(); confirmLogout();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</nav>