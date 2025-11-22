@extends('layouts.app')

@section('title', 'All Users')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_all_users.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="search-container mb-4">
            <input 
                type="text" 
                name="search" 
                placeholder="Search by username or role..."
                value="{{ request('search') }}"
                class="search-input"
            >
            <button type="submit" class="search-btn">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="clear-btn">Clear</a>
            @endif
        </form>

        <div class="table-card">
            <div class="table-responsive">
                <table class="all-users-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <div class="action-buttons-container">
                                        <form action="{{ route('admin.users.remove', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn remove" title="Remove user">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.users.change_password', $user->id) }}" class="action-btn update">
                                            Change Password
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center empty-row">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Components --}}
        @include('components.admin.floating-add-button')
        @include('components.admin.add-user-modal')
        @include('components.admin.modal-script')

    </div>
@endsection
