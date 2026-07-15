<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;


class SuratMasukController extends Controller
{


    public function index()
    {

        $user = Auth::user();


        $surat = Surat::whereHas(
            'disposisiTujuans',
            function($q) use($user){

                $q->where(
                    'penerima_id',
                    $user->id
                );

            }
        )
        ->latest()
        ->paginate(10);



        return view(
            'pegawai.surat.masuk.index',
            compact('surat')
        );

    }




    public function show($id)
    {

        $surat = Surat::findOrFail($id);


        return view(
            'pegawai.surat.masuk.show',
            compact('surat')
        );

    }


}