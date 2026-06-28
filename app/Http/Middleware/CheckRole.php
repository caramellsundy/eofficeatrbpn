<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek kecocokan role
        if (Auth::user()->role !== $role) {
            // Daripada redirect terus menerus yang bisa menyebabkan "too many redirects", 
            // kita berikan pesan error atau arahkan ke halaman utama
            return redirect()->route('dashboard.index')
                             ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}