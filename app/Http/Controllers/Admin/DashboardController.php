<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Surat;
use App\Models\Disposisi;
use App\Models\Pegawai;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        $totalUser = User::count();

        $totalAdmin = User::where('role', 'admin')->count();

        $totalPegawai = User::where('role', 'pegawai')->count();

        $totalUmum = User::where('role', 'umum')->count();


        /*
        |--------------------------------------------------------------------------
        | SURAT
        |--------------------------------------------------------------------------
        */

        $totalSurat = Surat::count();

        $suratMasuk = Surat::where('jenis_surat', 'masuk')->count();

        $suratKeluar = Surat::where('jenis_surat', 'keluar')->count();


        /*
        |--------------------------------------------------------------------------
        | DISPOSISI
        |--------------------------------------------------------------------------
        */

        $totalDisposisi = Disposisi::count();


        /*
        |--------------------------------------------------------------------------
        | PEGAWAI
        |--------------------------------------------------------------------------
        */

        $totalPegawaiData = Pegawai::count();


        /*
        |--------------------------------------------------------------------------
        | HARI INI
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $suratMasukHariIni = Surat::where('jenis_surat', 'masuk')
            ->whereDate('created_at', $today)
            ->count();

        $suratKeluarHariIni = Surat::where('jenis_surat', 'keluar')
            ->whereDate('created_at', $today)
            ->count();

        $disposisiHariIni = Disposisi::whereDate('created_at', $today)
            ->count();

        $userHariIni = User::whereDate('created_at', $today)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | SURAT TERBARU
        |--------------------------------------------------------------------------
        */

        $suratTerbaru = Surat::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATUS SURAT
        |--------------------------------------------------------------------------
        */

        $menunggu = Surat::where('status', 'menunggu')->count();

        $diproses = Surat::where('status', 'diproses')->count();

        $selesai = Surat::where('status', 'selesai')->count();


        return view('admin.dashboard', compact(

            'totalUser',
            'totalAdmin',
            'totalPegawai',
            'totalUmum',

            'totalSurat',
            'suratMasuk',
            'suratKeluar',

            'totalDisposisi',

            'totalPegawaiData',

            'suratMasukHariIni',
            'suratKeluarHariIni',
            'disposisiHariIni',
            'userHariIni',

            'suratTerbaru',

            'menunggu',
            'diproses',
            'selesai'

        ));
    }
}