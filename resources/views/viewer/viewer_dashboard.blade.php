@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-5">
        <h1>Welcome, {{ auth()->user()->username }}!</h1>
        <p>Your role: {{ auth()->user()->role }}</p>

        <div class="mt-4">
            <a href="{{ route('logout') }}" class="btn btn-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <div class="mt-4">
            <p>Here you can add viewer-specific features and controls.</p>
            <!-- Example: links to manage users, reports, etc. -->
        </div>
    </div>
@endsection