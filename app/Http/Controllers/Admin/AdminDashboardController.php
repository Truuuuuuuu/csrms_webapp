<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminDashboardController extends Controller
{
    // -------------------------
    // Admin dashboard
    // -------------------------
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

    // -------------------------
    // Remove user
    // -------------------------
    public function removeUser($id)
    {
        // Prevent admin from deleting themselves
        if (auth()->id() == $id) {
            return redirect()->back()->with('error', 'You cannot remove yourself.');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User removed successfully.');
    }

    // Show change password form
    public function showChangePassword($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('admin.change_password', compact('user'));
    }

    // Handle change password
    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed', // password + password_confirmation
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Password updated successfully.');
    }
}
