<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display all users with optional search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = User::query();

        $user = auth()->user();

        // Role filtering: superadmin and admin both cannot see other admins
        if (in_array($user->role, ['admin'])) {
            $query->where('role', '!=', 'admin'); 
        }elseif(in_array($user->role, ['superadmin'])) {
            $query->where('role', '!=', 'superadmin'); 
        }

        // Optionally, you can also hide superadmins for admins:
        if ($user->role === 'admin') {
            $query->where('role', '!=', 'superadmin'); // hide superadmins for admin
        }

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'LIKE', "%{$search}%")
                    ->orWhere('role', 'LIKE', "%{$search}%");
            });
        }

        // Pagination + sorting
        $users = $query->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

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
    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|min:6|confirmed', // password + password_confirmation
        ]);

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Password updated successfully.');
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
