<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Cek apakah user memiliki role 'admin'
        if (Auth::user()->isRole('admin')) {
            return $next($request);
        }

        // 3. Jika bukan admin, tolak akses (403 Forbidden)
        abort(403, 'Anda tidak memiliki akses sebagai Admin.');
    }
}