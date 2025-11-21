<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get all users
        $users = User::all();

        // Total users
        $totalUsers = $users->count();

        // Total student records (assuming role 'student')
        $totalStudents = $users->where('role', 'student')->count();

        return view('admin.admin_dashboard', compact('users', 'totalUsers', 'totalStudents'));
    }
}
