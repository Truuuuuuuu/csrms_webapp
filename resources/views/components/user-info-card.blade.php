<div class="user-info-card">
    <div class="user-avatar">
        <i class="bi bi-person-circle"></i>
    </div>
    <div class="user-details">
        <h2>Welcome, {{ $currentUsername }}</h2>
        <p class="user-role">Role: {{ ucfirst(auth()->user()->role) }}</p>
    </div>
</div>