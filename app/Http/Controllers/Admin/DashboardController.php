<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\User;
use App\Models\Pegawai;

class DashboardController extends Controller
{

    public function index()
    {

        $totalPegawai = User::where('role','pegawai')
            ->count();


        $totalSuratMasuk = Surat::where(
            'jenis_surat',
            'masuk'
        )->count();


        $totalSuratKeluar = Surat::where(
            'jenis_surat',
            'keluar'
        )->count();


        $suratTerbaru = Surat::latest()
            ->limit(5)
            ->get();



        return view(
            'admin.dashboard',
            compact(
                'totalPegawai',
                'totalSuratMasuk',
                'totalSuratKeluar',
                'suratTerbaru'
            )
        );

    }

}