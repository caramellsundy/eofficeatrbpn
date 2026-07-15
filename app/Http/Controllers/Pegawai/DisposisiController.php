<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;


class DisposisiController extends Controller
{


public function index()
{

$disposisi = Disposisi::with('surat')
    ->where(
        'penerima_id',
        Auth::id()
    )
    ->latest()
    ->paginate(10);



return view(
'pegawai.disposisi.index',
compact('disposisi')
);


}



public function show($id)
{


$disposisi =
Disposisi::with('surat')
->findOrFail($id);



return view(
'pegawai.disposisi.show',
compact('disposisi')
);


}



public function cetak($id)
{


$disposisi =
Disposisi::findOrFail($id);



return view(
'pegawai.disposisi.cetak',
compact('disposisi')
);


}



}