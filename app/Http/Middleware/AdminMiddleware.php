<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       if (!session()->has('is_admin')) {
            return redirect()->route('admin.login');

        }
        // Check if the user is authenticated as an admin
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login')->withErrors(['message' => 'You must be logged in as an admin to access this page.']);
        }

        return $next($request);

    }
}
