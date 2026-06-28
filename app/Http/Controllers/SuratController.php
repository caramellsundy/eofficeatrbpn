<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\LogAktivitas; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    // --- TAMBAHKAN METHOD INI UNTUK MENGATASI ERROR ---
    public function cariBerkasForm()
    {
        return view('umum.cari');
    }

    // --- FITUR UTAMA: DAFTAR SURAT DENGAN FILTER MODERN ---
    public function index(Request $request)
    {
        $type = in_array($request->query('type'), ['masuk', 'keluar', 'disposisi']) 
                ? $request->query('type') : 'masuk';
        
        $query = Surat::where('jenis_surat', $type);
        
        if ($request->has('filter')) {
            if ($request->filter == 'prioritas') {
                $query->where('is_priority', true);
            } elseif ($request->filter == 'otomatis') {
                $query->where('is_priority', false); 
            }
        }
        
        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }

        $surats = $query->latest()->paginate(10)->withQueryString();
        
        return view('pegawai.surat.index', compact('surats', 'type'));
    }

    public function create(Request $request)
    {
        $type = in_array($request->query('type'), ['masuk', 'keluar', 'disposisi']) 
                ? $request->query('type') : 'masuk';
        
        return view('pegawai.surat.create', compact('type'));
    }

    public function indexUmum()
    {
        $surats = Surat::where('user_id', Auth::id())->latest()->paginate(10);
        return view('umum.index', compact('surats'));
    }

    public function cariBerkas(Request $request)
    {
        $request->validate([
            'kantor' => 'required',
            'nomor_berkas' => 'required',
            'tahun' => 'required',
        ]);

        $surat = Surat::where('nomor_surat', $request->nomor_berkas)
                      ->whereYear('tanggal_surat', $request->tahun)
                      ->first();

        if ($surat) {
            return back()->with('success', 'Berkas ditemukan: ' . $surat->judul_surat);
        } else {
            return back()->with('error', 'Maaf, berkas tidak ditemukan atau data tidak sesuai.');
        }
    }

    // --- FUNGSI STORE DENGAN LOG ---
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'deskripsi'   => 'required',
        ]);

        $isPriority = str_contains(strtolower($request->deskripsi), 'segera') || 
                      str_contains(strtolower($request->deskripsi), 'penting');

        $surat = Surat::create([
            'user_id'     => auth()->id(),
            'nomor_surat' => $request->nomor_surat,
            'deskripsi'   => $request->deskripsi,
            'status'      => 'menunggu', 
            'is_priority' => $isPriority,
        ]);

        // Pencatatan Log
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'action' => 'Tambah Surat',
            'description' => 'User menambah surat dengan nomor: ' . $request->nomor_surat
        ]);

        return redirect()->route('pegawai.surat.index')->with('success', 'Surat berhasil dikirim!');
    }

    public function cetakDisposisi($id)
    {
        $surat = Surat::findOrFail($id);
        return view('pegawai.surat.cetak_disposisi', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $query = Surat::query();
        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }
        $surat = $query->findOrFail($id);
        $surat->update($request->all());

        // Pencatatan Log
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'action' => 'Update Surat',
            'description' => 'Memperbarui data surat ID: ' . $id
        ]);

        return redirect()->route('pegawai.surat.index', ['type' => $surat->jenis_surat])
                         ->with('success', 'Data surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $query = Surat::query();
        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }
        
        $surat = $query->findOrFail($id);
        $nomor = $surat->nomor_surat;
        
        if ($surat->file_path) {
            Storage::disk('public')->delete($surat->file_path);
        }
        
        $jenis = $surat->jenis_surat;
        $surat->delete();

        // Pencatatan Log
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'action' => 'Hapus Surat',
            'description' => 'Menghapus surat nomor: ' . $nomor
        ]);

        return redirect()->route('pegawai.surat.index', ['type' => $jenis])
                         ->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status = $request->status;
        $surat->catatan_admin = $request->catatan; 
        $surat->save();

        // Pencatatan Log
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'action' => 'Update Status',
            'description' => 'Mengubah status surat ' . $surat->nomor_surat . ' menjadi ' . $request->status
        ]);

        return redirect()->route('admin.surat.index')->with('success', 'Status surat berhasil diperbarui!');
    }

    private function validateSurat(Request $request)
    {
        // ... (kode validasi tidak diubah sesuai permintaan)
        return $request->validate([
            'jenis_surat'   => 'required|in:masuk,keluar,disposisi',
            'nomor_surat'   => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'dokumen'       => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'nomor_agenda'  => $request->jenis_surat === 'disposisi' ? 'required' : 'nullable',
            'perihal'       => $request->jenis_surat === 'disposisi' ? 'required' : 'nullable',
            'kode_surat'    => $request->jenis_surat !== 'disposisi' ? 'required' : 'nullable',
            'judul_surat'   => $request->jenis_surat !== 'disposisi' ? 'required' : 'nullable',
            'metode'        => $request->jenis_surat !== 'disposisi' ? 'required' : 'nullable',
            'asal_surat'    => $request->jenis_surat !== 'disposisi' ? 'required' : 'nullable',
        ]);
    }
}