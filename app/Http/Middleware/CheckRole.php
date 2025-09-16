<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles (comma separated: admin,student,instructor)
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect('/'); // not logged in
        }

        $user = Auth::user();
        $allowedRoles = explode(',', $roles);

        // Admin can access everything
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // Check other roles
        foreach ($allowedRoles as $role) {
            if ($user->hasRole(trim($role))) {
                return $next($request);
            }
        }

        // Unauthorized: redirect to allowed page
        if ($user->hasRole('student')) {
            return redirect()->route('home');
        } elseif ($user->hasRole('instructor')) {
            return redirect()->route('home');
        }

        // fallback
        return redirect('/');
    }
}
