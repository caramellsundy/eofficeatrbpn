<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\UnitKerja;
use Illuminate\Http\Request;

class AdminUnitKerjaController extends Controller
{
    /**
     * =====================================================
     * DAFTAR UNIT KERJA
     * =====================================================
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $unitKerja = UnitKerja::when($keyword, function ($query) use ($keyword) {

                $query->where('kode', 'like', "%{$keyword}%")
                      ->orWhere('nama', 'like', "%{$keyword}%")
                      ->orWhere('deskripsi', 'like', "%{$keyword}%");

            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.unitkerja.index',
            compact('unitKerja')
        );
    }

    /**
     * =====================================================
     * FORM TAMBAH
     * =====================================================
     */
    public function create()
    {
        return view('admin.unitkerja.create');
    }

    /**
     * =====================================================
     * SIMPAN
     * =====================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode'       => 'required|max:20|unique:unit_kerja,kode',
            'nama'       => 'required|max:255|unique:unit_kerja,nama',
            'deskripsi'  => 'nullable|max:500',
        ],[
            'kode.required' => 'Kode Unit Kerja wajib diisi.',
            'kode.unique'   => 'Kode sudah digunakan.',

            'nama.required' => 'Nama Unit Kerja wajib diisi.',
            'nama.unique'   => 'Nama Unit Kerja sudah digunakan.',
        ]);

        UnitKerja::create([

            'kode'       => $request->kode,
            'nama'       => $request->nama,
            'deskripsi'  => $request->deskripsi,

        ]);

        return redirect()
            ->route('admin.unitkerja.index')
            ->with('success','Unit Kerja berhasil ditambahkan.');
    }

    /**
     * =====================================================
     * DETAIL
     * =====================================================
     */
    public function show($id)
    {
        $unitKerja = UnitKerja::with('pegawai')
            ->findOrFail($id);

        return view(
            'admin.unitkerja.show',
            compact('unitKerja')
        );
    }

    /**
     * =====================================================
     * FORM EDIT
     * =====================================================
     */
    public function edit($id)
    {
        $unitKerja = UnitKerja::findOrFail($id);

        return view(
            'admin.unitkerja.edit',
            compact('unitKerja')
        );
    }

    /**
     * =====================================================
     * UPDATE
     * =====================================================
     */
    public function update(Request $request, $id)
    {
        $unitKerja = UnitKerja::findOrFail($id);

        $request->validate([

            'kode' => 'required|max:20|unique:unit_kerja,kode,' . $unitKerja->id,

            'nama' => 'required|max:255|unique:unit_kerja,nama,' . $unitKerja->id,

            'deskripsi' => 'nullable|max:500',

        ]);

        $unitKerja->update([

            'kode'       => $request->kode,
            'nama'       => $request->nama,
            'deskripsi'  => $request->deskripsi,

        ]);

        return redirect()
            ->route('admin.unitkerja.index')
            ->with('success','Unit Kerja berhasil diperbarui.');
    }

    /**
     * =====================================================
     * HAPUS
     * =====================================================
     */
    public function destroy($id)
    {
        $unitKerja = UnitKerja::withCount('pegawai')
            ->findOrFail($id);

        if ($unitKerja->pegawai_count > 0) {

            return back()->with(
                'error',
                'Unit Kerja masih digunakan oleh pegawai.'
            );

        }

        $unitKerja->delete();

        return redirect()
            ->route('admin.unitkerja.index')
            ->with('success','Unit Kerja berhasil dihapus.');
    }
}