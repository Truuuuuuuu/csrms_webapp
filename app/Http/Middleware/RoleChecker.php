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
        
        // If user is not authenticated, redirect to login instead of showing 403
        if (!$user) {
            return redirect()->route('auth.login');
        }
        
        // If user is authenticated but doesn't have the required role, show 403
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized');
        }
        
        return $next($request);
    }
}
