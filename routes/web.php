<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\RoleChecker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Editor\EditorDashboardController;
use App\Http\Controllers\Viewer\ViewerDashboardController;
use App\Http\Controllers\Auth\LogoutController;

// -------------------------
// Redirect root to login
// -------------------------
Route::get('/', function () {
    return redirect()->route('auth.login');
});

// -------------------------
// Authentication Routes
// -------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// -------------------------
// Role-protected Routes
// -------------------------
// Admin-only
Route::middleware([RoleChecker::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

// Editor + Admin
Route::middleware([RoleChecker::class.':editor,admin'])->group(function () {
    Route::get('/editor/dashboard', [EditorDashboardController::class, 'index'])
        ->name('editor.dashboard');
});
//TEMPORARY!!!
// Viwer + Admin
Route::middleware([RoleChecker::class.':viewer'])->group(function () {
    Route::get('/viewer/dashboard', [ViewerDashboardController::class, 'index'])
        ->name('viewer.dashboard');
});

// Viewer + Editor + Admin
Route::middleware([RoleChecker::class.':viewer,editor,admin'])->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard Page';
    })->name('dashboard');
});

/* Logout */
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
