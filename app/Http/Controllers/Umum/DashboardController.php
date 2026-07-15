<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Models\Surat;

class DashboardController extends Controller
{

    public function index()
    {

        $totalSurat = Surat::count();


        $suratMasuk = Surat::where(
            'jenis_surat',
            'masuk'
        )->count();


        $suratKeluar = Surat::where(
            'jenis_surat',
            'keluar'
        )->count();



        return view(
            'umum.dashboard',
            compact(
                'totalSurat',
                'suratMasuk',
                'suratKeluar'
            )
        );

    }

}