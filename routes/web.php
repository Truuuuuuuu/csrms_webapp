<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Editor\EditorDashboardController;
use App\Http\Controllers\Viewer\ViewerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleChecker;
use Illuminate\Support\Facades\Route;
// -------------------------
// Redirect root to login
// -------------------------
Route::get('/', function () {
    return redirect()->route('auth.login');
});

// -------------------------
// Authentication Routes
// -------------------------
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('auth.login')
    ->middleware('no.cache'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// -------------------------
// Role-protected Routes
// -------------------------

// Admin-only
Route::middleware([RoleChecker::class . ':admin', 'no.cache'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

     // All Users page
    Route::get('/admin/users', function () {
        // Optional: pass users if needed
        $users = \App\Models\User::all(); 
        return view('admin.admin_all_users', compact('users'));
    })->name('admin.users');
});

// Editor + Admin
Route::middleware([RoleChecker::class . ':editor,admin', 'no.cache'])->group(function () {
    Route::get('/editor/dashboard', [EditorDashboardController::class, 'index'])
        ->name('editor.dashboard');
});

// Viewer + Admin
Route::middleware([RoleChecker::class . ':viewer,admin', 'no.cache'])->group(function () {
    Route::get('/viewer/dashboard', [ViewerDashboardController::class, 'index'])
        ->name('viewer.dashboard');
});

// Generic dashboard for all authenticated roles
Route::middleware([RoleChecker::class . ':viewer,editor,admin', 'no.cache'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->hasRole('editor')) {
            return redirect()->route('editor.dashboard');
        }
        if ($user->hasRole('viewer')) {
            return redirect()->route('viewer.dashboard');
        }

        // fallback, in case role is missing
        abort(403, 'Unauthorized');
    })->name('dashboard');
});

// Profile routes - accessible to all authenticated users
Route::middleware([RoleChecker::class . ':viewer,editor,admin', 'no.cache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::middleware([RoleChecker::class . ':admin', 'no.cache'])->group(function () {
    Route::delete('/admin/users/{id}', [AdminDashboardController::class, 'removeUser'])->name('admin.users.remove');
    Route::get('/admin/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::get('/admin/users/{id}/change-password', [AdminDashboardController::class, 'showChangePassword'])->name('admin.users.change_password');
    Route::post('/admin/users/{id}/change-password', [AdminDashboardController::class, 'changePassword'])->name('admin.users.change_password.post');
});

