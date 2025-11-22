<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display all users with optional search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::query();

        if (!empty($search)) {
            $query->where('username', 'LIKE', "%{$search}%")
                ->orWhere('role', 'LIKE', "%{$search}%");
        }

        $users = $query->orderBy('username')->get();

        return view('admin.admin_all_users', compact('users', 'search'));
    }

    /**
     * Remove a user.
     */
    public function remove($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'User removed successfully.');
    }

    /**
     * Change password page.
     */
    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.change_password', compact('user'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|in:admin,editor,viewer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'username' => $validated['username'],
            'role' => $validated['role'],
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
}
