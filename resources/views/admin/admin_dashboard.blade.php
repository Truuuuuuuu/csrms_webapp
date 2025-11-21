@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="dashboard-container">
        <!-- Welcome -->
        <h1 class="mb-4 text-center">Welcome, {{ auth()->user()->username }}!</h1>

        <!-- Dashboard Cards -->
        <div class="cards-container">
            <div class="card card-blue">
                <h3 class="card-title">Total Users</h3>
                <p class="card-number">{{ $totalUsers }}</p>
            </div>

            <div class="card card-green">
                <h3 class="card-title">Total Student Records</h3>
                <p class="card-number">{{ $totalStudents }}</p>
            </div>
        </div>




        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table users-table">
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