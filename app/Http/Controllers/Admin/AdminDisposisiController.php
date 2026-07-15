<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Disposisi;
use App\Models\DisposisiTujuan;
use App\Models\Pegawai;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDisposisiController extends Controller
{
    /**
     * ==========================================================
     * DAFTAR DISPOSISI
     * ==========================================================
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $disposisi = Disposisi::with([
                'surat',
                'pengirim',
                'tujuans.pegawai'
            ])
            ->when($keyword, function ($query) use ($keyword) {

                $query->whereHas('surat', function ($q) use ($keyword) {

                    $q->where('nomor_surat', 'like', "%{$keyword}%")
                      ->orWhere('judul_surat', 'like', "%{$keyword}%")
                      ->orWhere('perihal', 'like', "%{$keyword}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.disposisi.index',
            compact('disposisi')
        );
    }

    /**
     * ==========================================================
     * FORM TAMBAH DISPOSISI
     * ==========================================================
     */
    public function create()
    {
        $surat = Surat::orderByDesc('tanggal_surat')
                    ->get();

        $pegawai = Pegawai::orderBy('nama')
                    ->get();

        return view(
            'admin.disposisi.create',
            compact(
                'surat',
                'pegawai'
            )
        ); 
    }
        /**
     * ==========================================================
     * SIMPAN DISPOSISI BARU
     * ==========================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'surat_id'            => 'required|exists:surats,id',
            'pegawai_id'          => 'required|array|min:1',
            'pegawai_id.*'        => 'exists:pegawai,id',
            'catatan'             => 'required|string',
            'prioritas'           => 'required|in:Rendah,Sedang,Tinggi',
            'tanggal_disposisi'   => 'required|date',
        ],[
            'surat_id.required'          => 'Surat wajib dipilih.',
            'pegawai_id.required'        => 'Minimal satu pegawai dipilih.',
            'pegawai_id.array'           => 'Format pegawai tidak valid.',
            'catatan.required'           => 'Catatan disposisi wajib diisi.',
            'tanggal_disposisi.required' => 'Tanggal disposisi wajib diisi.',
        ]);

        DB::beginTransaction();

        try {

            // Simpan disposisi
            $disposisi = Disposisi::create([

                'surat_id'           => $request->surat_id,
                'pengirim_id'        => Auth::id(),
                'catatan'            => $request->catatan,
                'prioritas'          => $request->prioritas,
                'tanggal_disposisi'  => $request->tanggal_disposisi,

            ]);

            // Simpan tujuan disposisi
            foreach ($request->pegawai_id as $pegawai) {

                DisposisiTujuan::create([

                    'disposisi_id' => $disposisi->id,
                    'pegawai_id'   => $pegawai,
                    'status'       => 'Belum Dibaca',

                ]);
            }

            // Update status surat menjadi diproses
            $disposisi->surat()->update([

                'status' => 'diproses'

            ]);

            DB::commit();

            return redirect()
                    ->route('admin.disposisi.index')
                    ->with(
                        'success',
                        'Disposisi berhasil dikirim kepada pegawai.'
                    );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Gagal menyimpan disposisi. ' . $e->getMessage()
                    );

        }
        
    }
            /**
     * ==========================================================
     * DETAIL DISPOSISI
     * ==========================================================
     */
    public function show($id)
    {
        $disposisi = Disposisi::with([
            'surat',
            'pengirim',
            'tujuans.pegawai'
        ])->findOrFail($id);

        return view(
            'admin.disposisi.show',
            compact('disposisi')
        );
    }

    /**
     * ==========================================================
     * FORM EDIT DISPOSISI
     * ==========================================================
     */
    public function edit($id)
    {
        $disposisi = Disposisi::with([
            'tujuans'
        ])->findOrFail($id);

        $surat = Surat::orderByDesc('tanggal_surat')
                    ->get();

        $pegawai = Pegawai::orderBy('nama')
                    ->get();

        // Pegawai yang sudah menjadi tujuan disposisi
        $pegawaiDipilih = $disposisi->tujuans
            ->pluck('pegawai_id')
            ->toArray();

        return view(
            'admin.disposisi.edit',
            compact(
                'disposisi',
                'surat',
                'pegawai',
                'pegawaiDipilih'
            )
        );
    }


    /**
     * ==========================================================
     * UPDATE DISPOSISI
     * ==========================================================
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'surat_id'            => 'required|exists:surats,id',
            'pegawai_id'          => 'required|array|min:1',
            'pegawai_id.*'        => 'exists:pegawai,id',
            'catatan'             => 'required|string',
            'prioritas'           => 'required|in:Rendah,Sedang,Tinggi',
            'tanggal_disposisi'   => 'required|date',
        ]);

        DB::beginTransaction();

        try {

            $disposisi = Disposisi::findOrFail($id);

            $disposisi->update([
                'surat_id'          => $request->surat_id,
                'catatan'           => $request->catatan,
                'prioritas'         => $request->prioritas,
                'tanggal_disposisi' => $request->tanggal_disposisi,
            ]);

            // Hapus tujuan lama
            DisposisiTujuan::where('disposisi_id', $disposisi->id)
                ->delete();

            // Simpan tujuan baru
            foreach ($request->pegawai_id as $pegawai) {

                DisposisiTujuan::create([
                    'disposisi_id' => $disposisi->id,
                    'pegawai_id'   => $pegawai,
                    'status'       => 'Belum Dibaca',
                ]);

            }

            DB::commit();

            return redirect()
                ->route('admin.disposisi.index')
                ->with('success', 'Disposisi berhasil diperbarui.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui disposisi. ' . $e->getMessage());

        }
    }

    /**
     * ==========================================================
     * HAPUS DISPOSISI
     * ==========================================================
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $disposisi = Disposisi::findOrFail($id);

            // Hapus seluruh tujuan disposisi
            DisposisiTujuan::where('disposisi_id', $disposisi->id)
                ->delete();

            // Hapus disposisi
            $disposisi->delete();

            DB::commit();

            return redirect()
                ->route('admin.disposisi.index')
                ->with('success', 'Disposisi berhasil dihapus.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', 'Gagal menghapus disposisi. ' . $e->getMessage());

        }
    }
}
    
    