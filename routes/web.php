<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController, AdminController, SuratController, 
    AdminSuratController, ProfileController, UserController, 
    Auth\AuthenticatedSessionController, Auth\RegisteredUserController,
    Auth\PasswordResetLinkController, Auth\NewPasswordController
};

// 1. Redirect Awal
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.index');
    }
    return redirect()->route('login');
});

// --- RUTE PUBLIK ---
Route::get('/umum/cari', [SuratController::class, 'cariBerkasForm'])->name('umum.cari.form');
Route::post('/umum/cari', [SuratController::class, 'cariBerkas'])->name('umum.cari.proses');

// 2. Rute Guest
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']); 
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// 3. Rute Terlindungi (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole('admin')) return redirect()->route('admin.dashboard');
        if ($user->hasRole('pegawai')) return redirect()->route('pegawai.dashboard');
        return redirect()->route('dashboard.umum');
    })->name('dashboard.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE UMUM ---
    Route::middleware(['checkRole:umum'])->group(function () {
        Route::get('/dashboard/umum', [DashboardController::class, 'umumIndex'])->name('dashboard.umum');
        Route::get('/umum/surat', [SuratController::class, 'indexUmum'])->name('umum.surat.index');
    });

    // --- RUTE ADMIN ---
    Route::middleware(['checkRole:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');
        
        Route::get('/users', [AdminController::class, 'userIndex'])->name('users');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::patch('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('users.updateRole');
        Route::patch('/users/{id}/reset-password', [AdminController::class, 'resetUserPassword'])->name('users.resetPassword');
        
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

        Route::prefix('surat')->name('surat.')->group(function () {
            Route::get('/', [SuratController::class, 'index'])->name('index'); 
            Route::get('/{id}', [SuratController::class, 'show'])->name('show'); // Rute untuk detail surat
            Route::get('/{id}/edit', [SuratController::class, 'edit'])->name('edit');
            Route::patch('/{id}/approve', [SuratController::class, 'approve'])->name('approve');
            Route::patch('/{id}/update-status', [SuratController::class, 'updateStatus'])->name('updateStatus');
            Route::delete('/{id}', [SuratController::class, 'destroy'])->name('destroy');
        });
    });

    // --- RUTE PEGAWAI ---
    Route::middleware(['checkRole:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'pegawaiIndex'])->name('dashboard');
        
        Route::prefix('surat')->name('surat.')->group(function () {
            Route::get('/', [SuratController::class, 'index'])->name('index'); 
            Route::get('/keluar', [SuratController::class, 'indexKeluar'])->name('keluar'); 
            Route::get('/disposisi', [SuratController::class, 'indexDisposisi'])->name('disposisi'); 
            Route::post('/', [SuratController::class, 'store'])->name('store'); 
            Route::get('/create', [SuratController::class, 'create'])->name('create');
            Route::get('/cetak-disposisi/{id}', [SuratController::class, 'cetakDisposisi'])->name('cetak.disposisi');
            Route::get('/{id}/edit', [SuratController::class, 'edit'])->name('edit'); 
            Route::put('/{id}', [SuratController::class, 'update'])->name('update');
            Route::delete('/{id}', [SuratController::class, 'destroy'])->name('destroy');
        });
    });
});