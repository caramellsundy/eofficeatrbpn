<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;

use App\Models\Surat;
use App\Http\Controllers\SuratController;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmumSuratController extends Controller
{
    /**
     * ==========================================================
     * DAFTAR SURAT
     * ==========================================================
     */
    public function index()
    {
        $surats = Surat::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('umum.surat.index', compact('surats'));
    }

    /**
     * ==========================================================
     * FORM TAMBAH
     * ==========================================================
     */
    public function create()
    {
        return view('umum.surat.create');
    }

    /**
     * ==========================================================
     * SIMPAN SURAT
     * ==========================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat'   => 'required|in:masuk,keluar',
            'nomor_surat'   => 'required',
            'tanggal_surat' => 'required|date',
            'perihal'       => 'required',
            'deskripsi'     => 'nullable',
            'asal_surat'    => 'nullable',
            'tujuan_surat'  => 'nullable',
            'metode'        => 'nullable',
            'file_path'     => 'nullable|file|max:5120',
        ]);

        $file = null;

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path')
                ->store('surat', 'public');
        }

        $surat = Surat::create([

            'user_id'        => Auth::id(),

            'jenis_surat'    => $request->jenis_surat,
            'nomor_surat'    => $request->nomor_surat,
            'tanggal_surat'  => $request->tanggal_surat,
            'nomor_agenda'   => $request->nomor_agenda,
            'kode_surat'     => $request->kode_surat,
            'judul_surat'    => $request->judul_surat,
            'perihal'        => $request->perihal,
            'asal_surat'     => $request->asal_surat,
            'tujuan_surat'   => $request->tujuan_surat,
            'penandatangan'  => $request->penandatangan,
            'metode'         => $request->metode,
            'deskripsi'      => $request->deskripsi,
            'file_path'      => $file,

            'status'         => 'menunggu',
            'is_priority'    => 0,
        ]);

        LogAktivitas::create([
            'user_id'     => Auth::id(),
            'surat_id'    => $surat->id,
            'action'      => 'Pengajuan Surat',
            'description' => 'Surat '.$surat->nomor_surat.' berhasil diajukan',
        ]);

        return redirect()
            ->route('umum.surat.index')
            ->with('success', 'Surat berhasil diajukan.');
    }

    /**
     * ==========================================================
     * DETAIL SURAT
     * ==========================================================
     */
    public function show($id)
    {
        $surat = Surat::with([
                'logs' => function ($query) {
                    $query->latest();
                },
                'logs.user'
            ])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('umum.surat.show', compact('surat'));
    }

    /**
     * ==========================================================
     * FORM EDIT
     * ==========================================================
     */
    public function edit($id)
    {
        $surat = Surat::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);

        return view('umum.surat.edit', compact('surat'));
    }

    /**
     * ==========================================================
     * UPDATE SURAT
     * ==========================================================
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat'   => 'required',
            'tanggal_surat' => 'required|date',
            'perihal'       => 'required',
            'deskripsi'     => 'nullable',
            'file_path'     => 'nullable|file|max:5120',
        ]);

        $surat = Surat::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);

        $data = [

            'nomor_surat'   => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'kode_surat'    => $request->kode_surat,
            'judul_surat'   => $request->judul_surat,
            'perihal'       => $request->perihal,
            'asal_surat'    => $request->asal_surat,
            'tujuan_surat'  => $request->tujuan_surat,
            'penandatangan' => $request->penandatangan,
            'metode'        => $request->metode,
            'deskripsi'     => $request->deskripsi,

        ];

        if ($request->hasFile('file_path')) {

            if ($surat->file_path) {
                Storage::disk('public')->delete($surat->file_path);
            }

            $data['file_path'] = $request->file('file_path')
                ->store('surat', 'public');
        }

        $surat->update($data);

        LogAktivitas::create([
            'user_id'     => Auth::id(),
            'surat_id'    => $surat->id,
            'action'      => 'Update Surat',
            'description' => 'Surat '.$surat->nomor_surat.' berhasil diperbarui',
        ]);

        return redirect()
            ->route('umum.surat.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * ==========================================================
     * HAPUS SURAT
     * ==========================================================
     */
    public function destroy($id)
{
    $surat = Surat::where('user_id', Auth::id())
        ->where('status', 'menunggu')
        ->findOrFail($id);

    if ($surat->file_path) {
        Storage::disk('public')->delete($surat->file_path);
    }

    LogAktivitas::create([
        'user_id'     => Auth::id(),
        'surat_id'    => $surat->id,
        'action'      => 'Hapus Surat',
        'description' => 'Surat '.$surat->nomor_surat.' dihapus oleh pemohon',
    ]);

    $surat->delete();

    return redirect()
        ->route('umum.surat.index')
        ->with('success', 'Surat berhasil dihapus.');
}

public function cariBerkasForm()
{
    return view('umum.cari');
}

public function cariBerkas(Request $request)
{
    $request->validate([
        'nomor_berkas' => 'required',
        'tahun' => 'required',
    ]);

    $surat = Surat::where('nomor_surat', $request->nomor_berkas)
        ->whereYear('tanggal_surat', $request->tahun)
        ->first();

    if ($surat) {
        return back()->with('success', 'Surat ditemukan.');
    }

    return back()->with('error', 'Surat tidak ditemukan.');
}

}