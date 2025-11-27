<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Editor\EditorDashboardController;
use App\Http\Controllers\Viewer\ViewerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleChecker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\StudentRecordsController;

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

// Super admin / Admin 
Route::middleware([RoleChecker::class . ':superadmin,admin', 'no.cache'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
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

        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
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

//Student records
Route::middleware(['auth', 'no.cache'])->group(function () {
    Route::get('/student-records', [StudentRecordsController::class, 'index'])->name('student.records');
    Route::post('/student-records', [StudentRecordsController::class, 'store'])->name('student.records.store');
    Route::delete('/student-records/{record}', [StudentRecordsController::class, 'destroy'])->name('student.records.destroy');
        Route::put(
            '/student-records/update-name/{record}',
        [StudentRecordsController::class, 'updateName'])
        ->name('student.records.updateName');

});
// Profile routes - accessible to all authenticated users
Route::middleware([RoleChecker::class . ':viewer,editor,admin,superadmin', 'no.cache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

/* SIDEBAR ACCESS */
Route::middleware([RoleChecker::class . ':superadmin,admin', 'no.cache'])->group(function () {
    Route::delete('/admin/users/{id}', [AdminDashboardController::class, 'removeUser'])->name('admin.users.remove');
    Route::get('/admin/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/admin/users/change-password', [AdminUserController::class, 'changePassword'])
        ->name('admin.users.change_password.post');

    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');
    Route::post('/admin/users', [AdminUserController::class, 'store'])
        ->name('admin.users.store');


});







Route::get('/student-records/{record}', [StudentRecordsController::class, 'show'])
    ->name('student_records.show');

Route::post('/student-records/upload/{record}', [StudentRecordsController::class, 'update'])
    ->name('student.records.upload');


Route::delete('/student-files/{file}', [StudentRecordsController::class, 'destroy'])->name('student.files.destroy');

