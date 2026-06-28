<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Authenticate kredensial email & password
        $request->authenticate();
        
        // 2. Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        $user = Auth::user();
        $selectedRole = $request->input('login_as');

        // 3. Validasi: Cocokkan role di database dengan role yang dipilih user
        if ($user->role !== $selectedRole) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akses ditolak: Akun ini tidak terdaftar sebagai ' . ucfirst($selectedRole),
            ]);
        }

        // 4. Redirect ke dashboard spesifik berdasarkan role
        return match ($selectedRole) {
            'admin'   => redirect()->route('admin.dashboard'),
            'pegawai' => redirect()->route('pegawai.dashboard'),
            default   => redirect()->route('dashboard.umum'),
        };
    }

    /**
     * Menangani proses logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}