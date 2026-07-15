<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class AdminPegawaiController extends Controller
{
    /**
     * Menampilkan daftar pegawai
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $pegawai = Pegawai::with(['jabatan', 'unitKerja'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nip', 'like', "%{$keyword}%");
            })
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Form tambah pegawai
     */
    public function create()
    {
        $jabatan = Jabatan::orderBy('nama')->get();
        $unitKerja = UnitKerja::orderBy('nama')->get();

        return view('admin.pegawai.create', compact(
    'jabatan',
    'unitKerja'
));
    }

    /**
     * Simpan data pegawai
     */
    public function store(Request $request)
    {
        $request->validate([
        'nip' => 'required|unique:pegawai,nip',
        'nama' => 'required|string|max:100',
        'email' => 'nullable|email',
        'no_hp' => 'nullable|max:20',
        'alamat' => 'nullable',
        'jabatan_id' => 'required|exists:jabatan,id',
        'unit_kerja_id' => 'required|exists:unit_kerja,id',
        ]);

        Pegawai::create([
            'nip'             => $request->nip,
            'nama'            => $request->nama,
            'email'           => $request->email,
            'no_hp'           => $request->no_hp,
            'alamat'          => $request->alamat,
            'jabatan_id'      => $request->jabatan_id,
            'unit_kerja_id'   => $request->unit_kerja_id,
        ]);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Detail pegawai
     */
    public function show(Pegawai $pegawai)
{
    $pegawai->load(['jabatan', 'unitKerja']);

    return view('admin.pegawai.show', compact('pegawai'));
}
    /**
     * Form edit pegawai
     */
    public function edit(Pegawai $pegawai)
    {
        $jabatan = Jabatan::orderBy('nama')->get();
        $unitKerja = UnitKerja::orderBy('nama')->get();

        return view('admin.pegawai.edit', compact(
    'pegawai',
    'jabatan',
    'unitKerja'
));
    }

    /**
     * Update data pegawai
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nip'             => 'required|unique:pegawai,nip,' . $pegawai->id,
            'nama'            => 'required|string|max:100',
            'email'           => 'nullable|email',
            'no_hp'           => 'nullable|max:20',
            'alamat'          => 'nullable',
            'jabatan_id'      => 'required|exists:jabatan,id',
            'unit_kerja_id'   => 'required|exists:unit_kerja,id',
        ]);

        $pegawai->update([
            'nip'             => $request->nip,
            'nama'            => $request->nama,
            'email'           => $request->email,
            'no_hp'           => $request->no_hp,
            'alamat'          => $request->alamat,
            'jabatan_id'      => $request->jabatan_id,
            'unit_kerja_id'   => $request->unit_kerja_id,
        ]);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Hapus pegawai
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}