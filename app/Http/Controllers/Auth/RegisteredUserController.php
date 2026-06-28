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
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', 'in:admin,pegawai,umum'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Backup di kolom database
        ]);

        // 2. SINKRONISASI PENTING: Assign role ke Spatie
        // Ini memastikan middleware 'can:admin' atau 'role:admin' bekerja
        $user->assignRole($request->role);

        event(new Registered($user));

        Auth::login($user);

        // 3. LOGIKA PENGARAHAN DINAMIS
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('pegawai')) {
            return redirect()->route('dashboard.pegawai');
        }
        
        // Default untuk role 'umum'
        return redirect()->route('dashboard');
    }

}