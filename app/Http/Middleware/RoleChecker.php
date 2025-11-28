<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleChecker
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        
        // If user is not authenticated, redirect to login
        if (!$user) {
            Auth::logout();
            return redirect()->route('auth.login')->with('error', 'Please log in to access this page.');
        }
        
        // If user is authenticated but doesn't have the required role, redirect to login
        if (!in_array($user->role, $roles)) {
            return redirect()->route('auth.login')->with('error', 'You are not authorized to access this page.');
        }
        
        return $next($request);
    }
}
