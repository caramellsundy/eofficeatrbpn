<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Surat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSuratMasukController extends Controller
{
    /**
     * Daftar Surat Masuk
     */
    public function index()
{
    $query = Surat::where('jenis_surat', 'masuk');

    $totalSurat = (clone $query)->count();

    $menunggu = (clone $query)
        ->where('status','menunggu')
        ->count();

    $proses = (clone $query)
        ->where('status','proses')
        ->count();

    $selesai = (clone $query)
        ->where('status','selesai')
        ->count();

    $surat = $query
        ->latest()
        ->paginate(10);

    return view('admin.surat.masuk.index', compact(
        'surat',
        'totalSurat',
        'menunggu',
        'proses',
        'selesai'
    ));
}
    public function create()
    {
        return view('admin.surat.masuk.create');
    }

    /**
     * Simpan
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'   => 'required',
            'perihal'       => 'required',
            'tanggal_surat' => 'required|date',
        ]);

        $surat = Surat::create([
    'nomor_surat'   => $request->nomor_surat,
    'perihal'       => $request->perihal,
    'tanggal_surat' => $request->tanggal_surat,
    'jenis_surat'   => 'masuk',
    'status'        => 'menunggu',
    'user_id'       => $request->user_id,
]);


        // Log Admin
        LogAktivitas::create([
            'user_id'     => auth()->id(),
            'action'      => 'Tambah Surat Masuk',
            'description' => 'Menambahkan surat '.$surat->nomor_surat,
        ]);

        // Log User
        if ($surat->user_id) {

            LogAktivitas::create([
                'user_id'     => $surat->user_id,
                'surat_id'    => $surat->id,
                'action'      => 'Pengajuan',
                'description' => 'Surat berhasil diajukan',
            ]);

        }

        return redirect()
            ->route('admin.surat.masuk.index')
            ->with('success','Surat berhasil ditambahkan');
    }

    /**
     * Detail
     */
    public function show($id)
    {
        $surat = Surat::findOrFail($id);

        return view('admin.surat.masuk.show', compact('surat'));
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);

        return view('admin.surat.masuk.edit', compact('surat'));
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nomor_surat'   => 'required',
        'perihal'       => 'required',
        'tanggal_surat' => 'required|date',
        'status'        => 'required',
    ]);

    $surat = Surat::findOrFail($id);

    // Simpan status lama
    $statusLama = $surat->status;

    // Update data surat
    $surat->update([
        'nomor_surat'   => $request->nomor_surat,
        'perihal'       => $request->perihal,
        'tanggal_surat' => $request->tanggal_surat,
        'status'        => $request->status,
        'jenis_surat'   => 'masuk',
    ]);

    // Log aktivitas Admin
    LogAktivitas::create([
        'user_id'     => auth()->id(),
        'surat_id'    => $surat->id,
        'action'      => 'Update Surat',
        'description' => 'Admin memperbarui data surat ' . $surat->nomor_surat,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Log aktivitas untuk pemilik surat
    | Hanya dibuat jika status berubah
    |--------------------------------------------------------------------------
    */
    if ($surat->user_id && $statusLama != $surat->status) {

        switch ($surat->status) {

            case 'menunggu':

                LogAktivitas::create([
                    'user_id'     => $surat->user_id,
                    'surat_id'    => $surat->id,
                    'action'      => 'Verifikasi',
                    'description' => 'Surat sedang diverifikasi oleh Admin.',
                ]);

                break;

            case 'proses':

                LogAktivitas::create([
                    'user_id'     => $surat->user_id,
                    'surat_id'    => $surat->id,
                    'action'      => 'Proses',
                    'description' => 'Surat sedang diproses oleh Petugas.',
                ]);

                break;

            case 'selesai':

                LogAktivitas::create([
                    'user_id'     => $surat->user_id,
                    'surat_id'    => $surat->id,
                    'action'      => 'Selesai',
                    'description' => 'Surat telah selesai diproses dan dapat diunduh.',
                ]);

                break;

            case 'ditolak':

                LogAktivitas::create([
                    'user_id'     => $surat->user_id,
                    'surat_id'    => $surat->id,
                    'action'      => 'Ditolak',
                    'description' => 'Surat ditolak oleh Admin.',
                ]);

                break;
        }
    }

    return redirect()
        ->route('admin.surat.masuk.index')
        ->with('success', 'Surat berhasil diperbarui.');
}

    /**
     * Hapus
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->file_path) {
            Storage::disk('public')->delete($surat->file_path);
        }

        LogAktivitas::create([
            'user_id'     => auth()->id(),
            'action'      => 'Hapus Surat Masuk',
            'description' => 'Menghapus surat '.$surat->nomor_surat,
        ]);

        $surat->delete();

        return redirect()
            ->route('admin.surat.masuk.index')
            ->with('success','Surat berhasil dihapus');
    }
}