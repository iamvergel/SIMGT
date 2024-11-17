<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $loginPath = '/StEmelieLearningCenter.HopeSci66/sign-in';

        if (Auth::guard('admin')->check() && $request->is($loginPath)) {
            return redirect()->route('admin.admin_dashboard');
        }

        if (Auth::guard('student')->check() && $request->is($loginPath)) {
            return redirect()->route('includes.student_dashboard');
        }

        // Allow access to the login page if not authenticated
        if ($request->is($loginPath)) {
            return $next($request);
        }

        // If not logged in and trying to access a protected route
        if (!Auth::guard('admin')->check() && !Auth::guard('student')->check()) {
            return redirect($loginPath)->withErrors(['error' => 'You must be logged in to access this page.']);
        }

        return $next($request);
    }
}
