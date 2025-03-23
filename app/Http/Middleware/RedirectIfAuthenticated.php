<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $loginPath = '/';

        if (Auth::guard('admin')->check() && $request->is($loginPath)) {
            return redirect()->route('admin.admin_dashboard');
        }

        if (Auth::guard('student')->check() && $request->is($loginPath)) {
            return redirect()->route('showDashboardstudent');
        }

        if (Auth::guard('teacher')->check() && $request->is($loginPath)) {
            return view('teacher.teacher_dashboard');
        }
        
        if (Auth::guard('admission')->check() && $request->is($loginPath)) {
            return view('admission.admission_dashboard');
        }

        if (Auth::guard('registrar')->check() && $request->is($loginPath)) {
            return view('registrar.registrar_dashboard');
        }

        // if (Auth::guard('student')->check() && $request->is($loginPath)) {
        //     return redirect()->route('includes.student_dashboard');
        // }

        // Allow access to the login page if not authenticated
        if ($request->is($loginPath)) {
            return $next($request);
        }

        // If not logged in and trying to access a protected route
        if (!Auth::guard('admin')->check() && !Auth::guard('student')->check() && !Auth::guard('teacher')->check() && !Auth::guard('admission')->check() && !Auth::guard('registrar')->check()) {
            return redirect($loginPath)->withErrors(['error' => 'You must be logged in to access this page.']);
        }

        return $next($request);
    }
}
