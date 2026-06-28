<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log; // Menambahkan ini untuk keperluan log

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            // Kita mencoba mengirim link reset password
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);

        } catch (\Exception $e) {
            // Jika terjadi error sistem (seperti konfigurasi email/SMTP salah)
            // Kita catat errornya di log dan beri tahu user
            Log::error('Password Reset Error: ' . $e->getMessage());

            return back()->withInput($request->only('email'))
                         ->withErrors(['email' => 'Terjadi kesalahan sistem saat mengirim email. Silakan hubungi administrator.']);
        }
    }
}