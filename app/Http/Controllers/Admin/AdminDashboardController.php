<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentRecord;

class AdminDashboardController extends Controller
{
    // -------------------------
    // Admin dashboard
    // -------------------------
    public function index()
    {
        $user = auth()->user();
        $currentUsername = $user->username;

        // Base query
        $query = User::query();

        // Role filtering
        if ($user->role === 'superadmin') {
            // Superadmin sees all except other superadmins
            $query->where('role', '!=', 'superadmin');
        } elseif ($user->role === 'admin') {
            // Admin sees all except admins and superadmins
            $query->whereNotIn('role', ['admin', 'superadmin']);
        }

        // Paginate and sort
        $users = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        // Total users (after role filtering)
        $totalUsers = $users->total();

        // Total student records 
        $totalStudents = StudentRecord::count();

        return view('admin.admin_dashboard', compact(
            'users',
            'totalUsers',
            'totalStudents',
            'currentUsername'
        ));
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }



        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->route('admin.users')->with('success', 'Password updated successfully.');
    }
}
