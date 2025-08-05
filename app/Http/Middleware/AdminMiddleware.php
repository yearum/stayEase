<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Jika belum login sebagai admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Jika sudah login sebagai admin, lanjutkan
        return $next($request);
    }
}
