<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // --- DEBUGGING: Aktifkan baris ini untuk melihat data role yang dibaca sistem ---
        // dd(Auth::user()->role, $roles);
        // Jika Anda melihat hasil dump, itu berarti Middleware berjalan normal.
        // -----------------------------------------------------------------------------

        // Cek apakah role user ada dalam daftar role yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, berikan pesan error
        abort(403, 'Anda tidak memiliki akses sebagai ' . implode(', ', $roles));
    }
}