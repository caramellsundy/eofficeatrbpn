<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Menyimpan user baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // Registrasi publik tidak boleh membuat akun internal.
            'role'     => 'umum',
        ]);

        // Aktifkan jika menggunakan Spatie Permission
        /*
        if (method_exists($user, 'assignRole')) {
            $user->assignRole($request->role);
        }
        */

        event(new Registered($user));

        Auth::login($user);

        $request->session()->regenerate();

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pegawai') {
            return redirect()->route('pegawai.dashboard');
        }

        return redirect()->route('umum.dashboard');
    }
}
