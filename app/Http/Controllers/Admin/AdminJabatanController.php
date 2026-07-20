<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class AdminJabatanController extends Controller
{
    /**
     * Menampilkan daftar jabatan
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $jabatan = Jabatan::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.jabatan.index', compact('jabatan'));
    }

    /**
     * Form tambah jabatan
     */
    public function create()
    {
        return view('admin.jabatan.create');
    }

    /**
     * Simpan jabatan
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jabatan,nama',
        ], [
            'nama.required' => 'Nama jabatan wajib diisi.',
            'nama.unique'   => 'Nama jabatan sudah digunakan.',
        ]);

        Jabatan::create([
    'kode' => $request->kode,
    'nama' => $request->nama,
    'deskripsi' => $request->deskripsi,
]);
        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil ditambahkan.');
    }

    /**
     * Detail jabatan
     */
    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('admin.jabatan.show', compact('jabatan'));
    }

    /**
     * Form edit jabatan
     */
    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('admin.jabatan.edit', compact('jabatan'));
    }

    /**
     * Update jabatan
     */
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:jabatan,nama,' . $jabatan->id,
        ], [
            'nama.required' => 'Nama jabatan wajib diisi.',
            'nama.unique'   => 'Nama jabatan sudah digunakan.',
        ]);

        $jabatan->update([
    'kode' => $request->kode,
    'nama' => $request->nama,
    'deskripsi' => $request->deskripsi,
]);
        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil diperbarui.');
    }

    /**
     * Hapus jabatan
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::withCount('pegawai')->findOrFail($id);

        if ($jabatan->pegawai_count > 0) {
            return back()->with('error', 'Jabatan masih digunakan oleh pegawai dan tidak dapat dihapus.');
        }

        $jabatan->delete();

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil dihapus.');
    }
}
