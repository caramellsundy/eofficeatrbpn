<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPegawaiController;
use App\Http\Controllers\Admin\AdminJabatanController;
use App\Http\Controllers\Admin\AdminUnitKerjaController;
use App\Http\Controllers\Admin\AdminSuratMasukController;
use App\Http\Controllers\Admin\AdminSuratKeluarController;
use App\Http\Controllers\Admin\AdminDisposisiController;


/*
|--------------------------------------------------------------------------
| PEGAWAI
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\Pegawai\SuratMasukController as PegawaiSuratMasukController;
use App\Http\Controllers\Pegawai\SuratKeluarController as PegawaiSuratKeluarController;
use App\Http\Controllers\Pegawai\DisposisiController as PegawaiDisposisiController;


/*
|--------------------------------------------------------------------------
| UMUM
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Umum\DashboardController as UmumDashboardController;
use App\Http\Controllers\Umum\UmumSuratController;


/*
|--------------------------------------------------------------------------
| LAINNYA
|--------------------------------------------------------------------------
*/





/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function(){

    return auth()->check()
        ? redirect()->route('dashboard.index')
        : redirect()->route('login');

});



/*
|--------------------------------------------------------------------------
| REDIRECT DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function(){


    if(!auth()->check()){

        return redirect()->route('login');

    }


    return match(auth()->user()->role){


        'admin'
            => redirect()->route('admin.dashboard'),


        'pegawai'
            => redirect()->route('pegawai.dashboard'),


        'umum'
            => redirect()->route('umum.dashboard'),


        default
            => abort(403)

    };


})
->middleware('auth')
->name('dashboard.index');





/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/


Route::middleware('guest')->group(function(){


    Route::get('/login',
        [AuthenticatedSessionController::class,'create'])
        ->name('login');


    Route::post('/login',
        [AuthenticatedSessionController::class,'store']);



    Route::get('/register',
        [RegisteredUserController::class,'create'])
        ->name('register');



    Route::post('/register',
        [RegisteredUserController::class,'store'])
        ->name('register');


});



Route::post('/logout',
    [AuthenticatedSessionController::class,'destroy'])
    ->middleware('auth')
    ->name('logout');





/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function(){


    Route::get('/profile',
        [ProfileController::class,'edit'])
        ->name('profile.edit');


    Route::patch('/profile',
        [ProfileController::class,'update'])
        ->name('profile.update');


    Route::put('/profile/password',
        [ProfileController::class,'updatePassword'])
        ->name('profile.password.update');


    Route::delete('/profile',
        [ProfileController::class,'destroy'])
        ->name('profile.destroy');


});





/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','role:admin'])
->prefix('admin')
->name('admin.')
->group(function(){



    Route::get('/dashboard',
        [AdminDashboardController::class,'index'])
        ->name('dashboard');



    Route::resource(
        'surat-masuk',
        AdminSuratMasukController::class
    )
    ->names('surat.masuk');



    Route::resource(
        'surat-keluar',
        AdminSuratKeluarController::class
    )
    ->names('surat.keluar');



    Route::resource(
        'disposisi',
        AdminDisposisiController::class
    );



    Route::resource(
        'pegawai',
        AdminPegawaiController::class
    );



    Route::resource(
        'jabatan',
        AdminJabatanController::class
    );



    Route::resource(
        'unitkerja',
        AdminUnitKerjaController::class
    )
    ->names('unit.kerja');



    Route::controller(AdminController::class)->group(function(){


        Route::get('/laporan',
            'laporan')
            ->name('laporan.index');



        Route::get('/settings',
            'settings')
            ->name('settings.index');


    });


});







/*
|--------------------------------------------------------------------------
| PEGAWAI
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','role:pegawai'])
->prefix('pegawai')
->name('pegawai.')
->group(function(){



    Route::get('/dashboard',
        [PegawaiDashboardController::class,'index'])
        ->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | SURAT MASUK
    |--------------------------------------------------------------------------
    */


    Route::get('/surat-masuk',
        [PegawaiSuratMasukController::class,'index'])
        ->name('surat.masuk.index');


    Route::get('/surat-masuk/{id}',
        [PegawaiSuratMasukController::class,'show'])
        ->name('surat.masuk.show');




    /*
    |--------------------------------------------------------------------------
    | SURAT KELUAR
    |--------------------------------------------------------------------------
    */


    Route::get('/surat-keluar',
        [PegawaiSuratKeluarController::class,'index'])
        ->name('surat.keluar.index');



    Route::get('/surat-keluar/create',
        [PegawaiSuratKeluarController::class,'create'])
        ->name('surat.keluar.create');



    Route::post('/surat-keluar',
        [PegawaiSuratKeluarController::class,'store'])
        ->name('surat.keluar.store');



    Route::get('/surat-keluar/{id}',
        [PegawaiSuratKeluarController::class,'show'])
        ->name('surat.keluar.show');



    Route::get('/surat-keluar/{id}/edit',
        [PegawaiSuratKeluarController::class,'edit'])
        ->name('surat.keluar.edit');



    Route::put('/surat-keluar/{id}',
        [PegawaiSuratKeluarController::class,'update'])
        ->name('surat.keluar.update');



    Route::delete('/surat-keluar/{id}',
        [PegawaiSuratKeluarController::class,'destroy'])
        ->name('surat.keluar.destroy');




    /*
    |--------------------------------------------------------------------------
    | DISPOSISI
    |--------------------------------------------------------------------------
    */


    Route::get('/disposisi',
        [PegawaiDisposisiController::class,'index'])
        ->name('disposisi.index');



    Route::get('/disposisi/{id}',
        [PegawaiDisposisiController::class,'show'])
        ->name('disposisi.show');



    Route::get('/disposisi/{id}/cetak',
        [PegawaiDisposisiController::class,'cetak'])
        ->name('disposisi.cetak');


});







/*
|--------------------------------------------------------------------------
| UMUM
|--------------------------------------------------------------------------
*/


Route::middleware('auth')
->prefix('umum')
->name('umum.')
->group(function(){



    Route::get('/dashboard',
        [UmumDashboardController::class,'index'])
        ->name('dashboard');



    Route::resource(
        'surat',
        UmumSuratController::class
    );



    Route::get('/cari',
    [UmumSuratController::class,'cariBerkasForm'])
    ->name('cari.form');



    Route::post('/cari',
    [UmumSuratController::class,'cariBerkas'])
    ->name('cari.proses');



    Route::view('/layanan',
        'umum.layanan.index')
        ->name('layanan.index');



    Route::view('/profil',
        'umum.profil')
        ->name('profil');



    Route::view('/struktur-organisasi',
        'umum.struktur')
        ->name('struktur');



    Route::view('/visi-misi',
        'umum.visi-misi')
        ->name('visi');



    Route::view('/menteri',
        'umum.menteri')
        ->name('menteri');



    Route::view('/wakil-menteri',
        'umum.wakil-menteri')
        ->name('wakil');


});