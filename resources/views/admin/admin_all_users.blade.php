@extends('layouts.app')

@section('title', 'All Users')


@section('content')
    <div class="dashboard-container">

        <!-- Success banner -->
        @if (session('success'))
            <div id="successBanner" class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Add User Button --}}
        <button class="btn btn-success add-user-btn" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-person-plus"></i> Add User
        </button>
        {{-- Search Form --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3" id="searchForm">
            <div class="input-group">

                {{-- Container for input + X button --}}
                <div class="position-relative flex-grow-1">

                    {{-- Search Input --}}
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input"
                        placeholder="Search by username or role..." id="searchInput">

                    {{-- Clear (X) Button --}}
                    @if(request('search'))
                        <button type="button" id="clearSearch"
                            class="btn position-absolute top-50 end-0 translate-middle-y p-0 me-2"
                            style="border: none; background: transparent; z-index: 10;">
                            <i class="bi bi-x" style="font-size: 2rem; cursor: pointer;"></i>
                        </button>
                    @endif

                </div>

                {{-- Search Button --}}
                <button type="submit" class="btn search-btn">
                    <i class="bi bi-search"></i> Search
                </button>

            </div>
        </form>

        {{-- Clear button JS --}}
        <script>
            document.getElementById('clearSearch')?.addEventListener('click', function () {
                document.getElementById('searchInput').value = '';
                document.getElementById('searchForm').submit();
            });
        </script>


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
                                        <form action="{{ route('admin.users.remove', $user->id) }}" method="POST"
                                            class="confirm-remove" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn remove" title="Remove user">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                        <a href="#" class="action-btn update" data-bs-toggle="modal"
                                            data-bs-target="#changePasswordModal" data-user-id="{{ $user->id }}"
                                            data-username="{{ $user->username }}">
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
            <x-pagination :paginator="$users" />
        </div>

        {{-- Components --}}
        @include('components.admin.add-user-modal')
        @include('components.admin.change-password-modal')

        <script src="{{ asset('js/admin_users.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                // Only open Change Password modal if its own validation failed
                @if ($errors->has('change_password') && old('user_id'))
                    var changeModalEl = document.getElementById('changePasswordModal');
                    if (changeModalEl) {
                        var changeModal = new bootstrap.Modal(changeModalEl);
                        changeModalEl.querySelector('input[name="user_id"]').value = "{{ old('user_id') }}";
                        changeModal.show();
                    }

                    // Only open Add User modal if its own validation failed
                @elseif ($errors->has('add_password') || $errors->has('username') || $errors->has('role'))
                    var addModalEl = document.getElementById('addUserModal');
                    if (addModalEl) {
                        var addModal = new bootstrap.Modal(addModalEl);
                        addModal.show();
                    }
                @endif

    });
        </script>



    </div>


@endsection