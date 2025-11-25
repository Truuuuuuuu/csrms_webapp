<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            // Username does not exist
            return back()->withErrors(['credentials' => 'Invalid credentials'])->withInput();
        }

        // Attempt login
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Password is wrong
            return back()->withErrors(['password' => 'Wrong password'])->withInput();
        }

        // Successful login
        $request->session()->regenerate();
        /*  return redirect()->intended('dashboard'); // change to your route */
        return $this->redirectByRole($user);
    }
    protected function redirectByRole(User $user)
    {
        switch ($user->role) {
            case 'superadmin':
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'editor':
                return redirect()->route('editor.dashboard');
            case 'viewer':
                return redirect()->route('viewer.dashboard');
            default:
                Auth::logout();
                session()->invalidate(); // Use global session helper
                return back()->withErrors(['credentials' => 'Invalid role'])->withInput();
        }
    }


}
