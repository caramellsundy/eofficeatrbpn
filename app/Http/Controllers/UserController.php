<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua user
        $users = User::all(); 
        return view('admin.user.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Memastikan role diupdate (asumsi Anda menggunakan paket Spatie)
        // Jika tidak menggunakan paket, Anda bisa melakukan: $user->update(['role' => $request->role]);
        $user->syncRoles([$request->role]); 
        
        return back()->with('success', 'Role user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return back()->with('success', 'User berhasil dihapus.');
    }
}