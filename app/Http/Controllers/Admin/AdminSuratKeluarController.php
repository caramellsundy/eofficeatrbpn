<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Surat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSuratKeluarController extends Controller
{
    public function index()
{
    $surat = Surat::where('jenis_surat', 'keluar')
        ->latest()
        ->paginate(10);

    $draft = Surat::where('jenis_surat', 'keluar')
        ->where('status', 'draft')
        ->count();

    $terkirim = Surat::where('jenis_surat', 'keluar')
        ->where('status', 'terkirim')
        ->count();

    $arsip = Surat::where('jenis_surat', 'keluar')
        ->whereIn('status', ['arsip', 'diarsipkan'])
        ->count();

    return view('admin.surat.keluar.index', compact(
        'surat',
        'draft',
        'terkirim',
        'arsip'
    ));
}
    public function create()
    {
        return view('admin.surat.keluar.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nomor_surat'=>'required|unique:surats',

            'tanggal_surat'=>'required|date',

            'tanggal_kirim'=>'nullable|date',

            'tanggal_keluar'=>'nullable|date',

            'tujuan_surat'=>'required',

            'penandatangan'=>'required',

            'perihal'=>'required',

        ]);

        $surat = Surat::create([

            'user_id'=>auth()->id(),

            'jenis_surat'=>'keluar',

            'nomor_surat'=>$request->nomor_surat,

            'tanggal_surat'=>$request->tanggal_surat,

            'tanggal_kirim'=>$request->tanggal_kirim,

            'tanggal_keluar'=>$request->tanggal_keluar,

            'tujuan_surat'=>$request->tujuan_surat,

            'penandatangan'=>$request->penandatangan,

            'perihal'=>$request->perihal,

            'status'=>$request->status ?? 'menunggu',

        ]);

        LogAktivitas::create([

            'user_id'=>auth()->id(),

            'surat_id'=>$surat->id,

            'action'=>'Tambah Surat Keluar',

            'description'=>'Menambahkan surat '.$surat->nomor_surat,

        ]);

        return redirect()
            ->route('admin.surat.keluar.index')
            ->with('success','Surat keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);

        return view('admin.surat.keluar.show',compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);

        return view('admin.surat.keluar.edit',compact('surat'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([

            'nomor_surat'=>'required|unique:surats,nomor_surat,'.$id,

            'tanggal_surat'=>'required|date',

            'tanggal_kirim'=>'nullable|date',

            'tanggal_keluar'=>'nullable|date',

            'tujuan_surat'=>'required',

            'penandatangan'=>'required',

            'perihal'=>'required',

            'status'=>'required',

        ]);

        $surat = Surat::findOrFail($id);

        $surat->update([

            'nomor_surat'=>$request->nomor_surat,

            'tanggal_surat'=>$request->tanggal_surat,

            'tanggal_kirim'=>$request->tanggal_kirim,

            'tanggal_keluar'=>$request->tanggal_keluar,

            'tujuan_surat'=>$request->tujuan_surat,

            'penandatangan'=>$request->penandatangan,

            'perihal'=>$request->perihal,

            'status'=>$request->status,

        ]);

        LogAktivitas::create([

            'user_id'=>auth()->id(),

            'surat_id'=>$surat->id,

            'action'=>'Update Surat Keluar',

            'description'=>'Mengubah surat '.$surat->nomor_surat,

        ]);

        return redirect()
            ->route('admin.surat.keluar.index')
            ->with('success','Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if($surat->file_path){
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        LogAktivitas::create([

            'user_id'=>auth()->id(),

            'action'=>'Hapus Surat Keluar',

            'description'=>'Menghapus surat '.$surat->nomor_surat,

        ]);

        return redirect()
            ->route('admin.surat.keluar.index')
            ->with('success','Surat berhasil dihapus.');
    }
}