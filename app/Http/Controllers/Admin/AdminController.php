<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */

    public function laporan()
    {
        return view('admin.laporan');
    }

    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */

    public function settings()
    {
        return view('admin.settings.index');
    }

    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function userIndex()
    {
        $users = User::latest()->get();

        $roles = class_exists(Role::class)
            ? Role::all()
            : collect();

        return view('admin.users.index', compact(
            'users',
            'roles'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE ROLE USER
    |--------------------------------------------------------------------------
    */

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string'
        ]);

        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {
            return back()->with(
                'error',
                'Anda tidak dapat mengubah role akun sendiri.'
            );
        }

        /*
        |------------------------------------------------------------
        | Update role pada tabel users
        |------------------------------------------------------------
        */

        $user->update([
            'role' => $request->role
        ]);

        /*
        |------------------------------------------------------------
        | Jika memakai Spatie Permission
        |------------------------------------------------------------
        */

        if (method_exists($user, 'syncRoles')) {
            $user->syncRoles($request->role);
        }

        return back()->with(
            'success',
            'Role berhasil diperbarui.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetUserPassword(Request $request, $id)
    {
        $request->validate([

            'password' => [
                'required',
                'confirmed',
                'min:8'
            ]

        ]);

        $user = User::findOrFail($id);

        $user->update([

            'password' => Hash::make(
                $request->password
            )

        ]);

        return back()->with(
            'success',
            'Password berhasil diperbarui.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS USER
    |--------------------------------------------------------------------------
    */

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {

            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );

        }

        $user->delete();

        return back()->with(
            'success',
            'User berhasil dihapus.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ABOUT
    |--------------------------------------------------------------------------
    */

    public function about()
    {
        return view('admin.settings.about');
    }

    /*
    |--------------------------------------------------------------------------
    | BACKUP
    |--------------------------------------------------------------------------
    */

    public function backup()
    {
        return view('admin.settings.backup');
    }
}