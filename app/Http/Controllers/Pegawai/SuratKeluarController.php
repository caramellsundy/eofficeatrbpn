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
        $query = Surat::where('user_id', Auth::id())
            ->where('jenis_surat', 'keluar');

        if ($request->filled('keyword')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nomor_surat',
                    'like',
                    '%' . $request->keyword . '%'
                )
                ->orWhere(
                    'perihal',
                    'like',
                    '%' . $request->keyword . '%'
                )
                ->orWhere(
                    'tujuan_surat',
                    'like',
                    '%' . $request->keyword . '%'
                );

            });

        }

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        $surat = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pegawai.surat.keluar.index',
            compact('surat')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
{
    $jabatans = Jabatan::orderBy('nama')->get();

    return view(
        'pegawai.surat.keluar.create',
        compact('jabatans')
    );
}

    /*
    |--------------------------------------------------------------------------
    | SIMPAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'nomor_surat'          => 'required|unique:surat,nomor_surat',

            'tanggal_surat'        => 'required|date',

            'perihal'              => 'required',

            'tujuan_surat'         => 'required',

            'jabatan_pimpinan_id'  => 'required',

            'nama_pimpinan'        => 'required',

            'deskripsi'            => 'nullable',

            'file_path'            => 'nullable|mimes:pdf,doc,docx|max:5120',

        ]);



        $file = null;

        if ($request->hasFile('file_path')) {

            $file = $request
                ->file('file_path')
                ->store(
                    'surat-keluar',
                    'public'
                );

        }



        $surat = Surat::create([

            'user_id' => Auth::id(),

            'jenis_surat' => 'keluar',

            'nomor_surat' => $request->nomor_surat,

            'tanggal_surat' => $request->tanggal_surat,

            'perihal' => $request->perihal,

            'tujuan_surat' => $request->tujuan_surat,

            'jabatan_pimpinan_id'
                => $request->jabatan_pimpinan_id,

            'nama_pimpinan'
                => $request->nama_pimpinan,

            'deskripsi'
                => $request->deskripsi,

            'file_path'
                => $file,

            'status'
                => 'Menunggu',

        ]);


        LogAktivitas::create([

            'user_id' => Auth::id(),

            'surat_id' => $surat->id,

            'action' => 'Membuat Surat Keluar',

            'description'
                => 'Membuat Surat Keluar '
                . $surat->nomor_surat,

        ]);


        return redirect()
            ->route('pegawai.surat-keluar.index')
            ->with(
                'success',
                'Surat keluar berhasil dibuat.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $surat = Surat::with('jabatanPimpinan')
            ->findOrFail($id);

        return view(
            'pegawai.surat.keluar.show',
            compact('surat')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->status != 'Menunggu') {

            return back()
                ->with(
                    'error',
                    'Surat yang sudah diproses tidak dapat diedit.'
                );

        }

        $jabatan = Jabatan::orderBy('nama')->get();

        return view(
            'pegawai.surat.keluar.edit',
            compact(
                'surat',
                'jabatan'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    )
    {

        $surat = Surat::findOrFail($id);

        if ($surat->status != 'Menunggu') {

            return back()
                ->with(
                    'error',
                    'Surat yang sudah diproses tidak dapat diedit.'
                );

        }

        $request->validate([

            'nomor_surat'
                => 'required|unique:surat,nomor_surat,' . $surat->id,

            'tanggal_surat'
                => 'required|date',

            'perihal'
                => 'required',

            'tujuan_surat'
                => 'required',

            'jabatan_pimpinan_id'
                => 'required',

            'nama_pimpinan'
                => 'required',

            'deskripsi'
                => 'nullable',

            'file_path'
                => 'nullable|mimes:pdf,doc,docx|max:5120',

        ]);


        if ($request->hasFile('file_path')) {

            if ($surat->file_path) {

                Storage::disk('public')
                    ->delete(
                        $surat->file_path
                    );

            }

            $surat->file_path =
                $request
                    ->file('file_path')
                    ->store(
                        'surat-keluar',
                        'public'
                    );
        }


        $surat->update([

            'nomor_surat'
                => $request->nomor_surat,

            'tanggal_surat'
                => $request->tanggal_surat,

            'perihal'
                => $request->perihal,

            'tujuan_surat'
                => $request->tujuan_surat,

            'jabatan_pimpinan_id'
                => $request->jabatan_pimpinan_id,

            'nama_pimpinan'
                => $request->nama_pimpinan,

            'deskripsi'
                => $request->deskripsi,

        ]);


        LogAktivitas::create([

            'user_id' => Auth::id(),

            'surat_id' => $surat->id,

            'action' => 'Mengubah Surat Keluar',

            'description'
                => 'Mengubah Surat '
                . $surat->nomor_surat,

        ]);


        return redirect()
            ->route('pegawai.surat-keluar.index')
            ->with(
                'success',
                'Surat berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->status != 'Menunggu') {

            return back()
                ->with(
                    'error',
                    'Surat yang sudah diproses tidak dapat dihapus.'
                );

        }

        if ($surat->file_path) {

            Storage::disk('public')
                ->delete(
                    $surat->file_path
                );

        }

        LogAktivitas::create([

            'user_id' => Auth::id(),

            'surat_id' => $surat->id,

            'action' => 'Menghapus Surat Keluar',

            'description'
                => 'Menghapus Surat '
                . $surat->nomor_surat,

        ]);

        $surat->delete();

        return redirect()
            ->route('pegawai.surat-keluar.index')
            ->with(
                'success',
                'Surat berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | KIRIM SURAT
    |--------------------------------------------------------------------------
    */

    public function kirim($id)
    {

        $surat = Surat::findOrFail($id);

        if ($surat->status != 'Menunggu') {

            return back()
                ->with(
                    'error',
                    'Surat sudah diproses.'
                );

        }

        $surat->update([

            'status' => 'Diproses'

        ]);


        LogAktivitas::create([

            'user_id' => Auth::id(),

            'surat_id' => $surat->id,

            'action' => 'Mengirim Surat Keluar',

            'description'
                => 'Mengirim Surat '
                . $surat->nomor_surat,

        ]);


        return redirect()
            ->route('pegawai.surat-keluar.index')
            ->with(
                'success',
                'Surat berhasil dikirim.'
            );
    }

}