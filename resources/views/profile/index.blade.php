@extends('layouts.app')

@section('title', 'Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <h1>My Profile</h1>
            <div class="profile-avatar">
                {{ strtoupper(substr($user->username, 0, 1)) }}
            </div>
            <div class="profile-username">{{ $user->username }}</div>
            <span class="profile-role-badge {{ $user->role }}">{{ ucfirst($user->role) }}</span>
        </div>

        <div class="profile-card">
            <div class="profile-card-header">
                <i class="bi bi-person-circle"></i> Profile Information
            </div>
            <div class="profile-card-body">
                <div class="profile-info-item">
                    <div class="profile-info-icon username">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Username</div>
                        <div class="profile-info-value">{{ $user->username }}</div>
                    </div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-info-icon role">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Role</div>
                        <div class="profile-info-value">
                            <span class="profile-role-badge {{ $user->role }}">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-info-icon date">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Account Created</div>
                        <div class="profile-info-value">
                            {{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-actions">
            @if($user->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="profile-btn profile-btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            @elseif($user->hasRole('editor'))
                <a href="{{ route('editor.dashboard') }}" class="profile-btn profile-btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            @elseif($user->hasRole('viewer'))
                <a href="{{ route('viewer.dashboard') }}" class="profile-btn profile-btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            @endif
        </div>
    </div>
@endsection

