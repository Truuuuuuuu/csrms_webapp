@extends('layouts.app')

@section('title', 'All Users')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_all_users.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">
        <h1 class="mb-4 text-center">All Users</h1>

        <div class="table-responsive">
            <table class="all-users-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th> {{-- New column --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                <div class="action-buttons-container">
                                    {{-- Action buttons --}}
                                    <form action="{{ route('admin.users.remove', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn remove">Remove</button>
                                    </form>

                                    <a href="{{ route('admin.users.change_password', $user->id) }}" class="action-btn update">Change
                                        Password</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection