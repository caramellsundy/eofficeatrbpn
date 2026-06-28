<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Admin
     */
    public function index() 
    {
        $data = [
            'totalSurat' => Surat::count(),
            'totalUser'  => User::count(),
            'suratBaru'  => Surat::where('status', 'menunggu')->count(),
        ];
        
        return view('admin.dashboard', compact('data'));
    }

    /**
     * Menampilkan Halaman Laporan
     */
    public function laporan()
    {
        return view('admin.laporan');
    }

    /**
     * Menampilkan Halaman Manajemen User
     */
    public function userIndex()
    {
        $users = User::with('roles')->get(); 
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    /**
     * Menghapus User
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }

    /**
     * Mengupdate Role User
     */
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak bisa mengubah role akun sendiri!');
        }
        
        // Sinkronisasi role Spatie
        $user->syncRoles($request->role);
        
        // Update kolom role di tabel users
        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users')->with('success', 'Role user berhasil diperbarui!');
    }

    /**
     * Reset Password User oleh Admin
     */
    public function resetUserPassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password user berhasil direset oleh Admin!');
    }

    /**
     * Menampilkan Halaman Pengaturan Sistem
     */
    public function settings()
    {
        return view('admin.pengaturan');
    }
}