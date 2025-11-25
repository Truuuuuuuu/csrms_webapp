@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="dashboard-container">
        @include('components.user-info-card')

        <!-- Dashboard Cards -->
        <div class="cards-container">
            <div class="card card-blue">
                <div class="card-top">
                    <div class="card-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <p class="card-number">{{ $totalUsers }}</p>
                </div>
                <h3 class="card-title">Total Users</h3>
            </div>

            <div class="card card-green">
                <div class="card-top">
                    <div class="card-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <p class="card-number">{{ $totalStudents }}</p>
                </div>
                <h3 class="card-title">Total Student Records</h3>
            </div>
        </div>



        <!-- Users Table -->
        <div class="table-responsive">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection