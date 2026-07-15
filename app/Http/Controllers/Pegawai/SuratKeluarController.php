<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SuratKeluarController extends Controller
{


public function index(Request $request)
{

    $surat = Surat::where('user_id',Auth::id())
        ->where('jenis_surat','keluar')
        ->when(
            $request->keyword,
            function($q) use($request){

                $q->where(function($x) use($request){

                    $x->where(
                        'nomor_surat',
                        'like',
                        '%'.$request->keyword.'%'
                    )
                    ->orWhere(
                        'perihal',
                        'like',
                        '%'.$request->keyword.'%'
                    );

                });

            }
        )
        ->latest()
        ->paginate(10);



    return view(
        'pegawai.surat.keluar.index',
        compact('surat')
    );

}



public function create()
{

    return view(
        'pegawai.surat-keluar.create'
    );

}



public function store(Request $request)
{


$request->validate([

    'nomor_surat'=>'required',

    'tanggal_surat'=>'required|date',

    'perihal'=>'required'

]);



$surat = Surat::create([

'user_id'=>Auth::id(),

'jenis_surat'=>'keluar',

'nomor_surat'=>$request->nomor_surat,

'tanggal_surat'=>$request->tanggal_surat,

'perihal'=>$request->perihal,

'deskripsi'=>$request->deskripsi,

'status'=>'menunggu'

]);



LogAktivitas::create([

'user_id'=>Auth::id(),

'surat_id'=>$surat->id,

'action'=>'Membuat Surat',

'description'=>'Surat '.$surat->nomor_surat

]);



return redirect()
->route('pegawai.surat.keluar.index')
->with(
'success',
'Surat berhasil dibuat'
);


}



public function show($id)
{

$surat=Surat::findOrFail($id);


return view(
'pegawai.surat.keluar.show',
compact('surat')
);

}



public function edit($id)
{

$surat=Surat::findOrFail($id);


return view(
'pegawai.surat.keluar.edit',
compact('surat')
);

}



public function update(Request $request,$id)
{

$surat=Surat::findOrFail($id);


$surat->update($request->all());


return redirect()
->route('pegawai.surat-keluar.index')
->with(
'success',
'Surat diperbarui'
);


}




public function destroy($id)
{


$surat=Surat::findOrFail($id);


if($surat->file_path){

Storage::disk('public')
->delete($surat->file_path);

}


$surat->delete();



return back()
->with(
'success',
'Surat dihapus'
);


}


}