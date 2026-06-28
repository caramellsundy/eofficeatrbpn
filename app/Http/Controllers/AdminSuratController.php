<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSuratController extends Controller
{
    // 1. Menampilkan daftar seluruh surat untuk Admin
    public function index(Request $request)
    {
        $query = Surat::query();

        // Menangani filter dari dashboard dengan pengecekan aman
        if ($request->filled('filter')) {
            if ($request->filter == 'prioritas') {
                // Menggunakan 1 secara eksplisit untuk memastikan kecocokan dengan TINYINT database
                $query->where('is_priority', 1);
            } elseif ($request->filter == 'otomatis') {
                // Menggunakan 0 secara eksplisit
                $query->where('is_priority', 0);
            }
        }

        // Urutkan berdasarkan data terbaru dan buat paginasi
        $surats = $query->latest()->paginate(10);
        
        // Menambahkan parameter filter ke link paginasi agar tidak hilang saat pindah halaman
        $surats->appends(['filter' => $request->filter]);
        
        return view('admin.surat.index', compact('surats'));
    }

    // --- FITUR BARU: Halaman Detail Surat ---
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    // --- FITUR BARU: Update Status via Halaman Detail ---
    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        
        $request->validate([
            'status' => 'required',
            'catatan' => 'nullable|string'
        ]);

        $surat->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan
        ]);

        return redirect()->route('admin.surat.index')->with('success', 'Status surat berhasil diperbarui.');
    }

    // 2. Fungsi Approve
    public function approve($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Surat berhasil disetujui.');
    }

    // 3. Fungsi Edit
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.edit', compact('surat'));
    }

    // 4. Fungsi Update
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        
        $validated = $request->validate([
            'nomor_surat'   => 'required|string|max:255',
            'judul_surat'   => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'status'        => 'required|in:pending,approved,rejected,selesai,revisi,ditolak',
        ]);

        if ($request->hasFile('dokumen')) {
            if ($surat->file_path) {
                Storage::disk('public')->delete($surat->file_path);
            }
            
            $fileName = time() . '_' . $request->file('dokumen')->getClientOriginalName();
            $path = $request->file('dokumen')->storeAs('surat', $fileName, 'public');
            $validated['file_path'] = $path;
        }

        $surat->update($validated);

        return redirect()->route('admin.surat.index')->with('success', 'Data surat berhasil diperbarui.');
    }

    // 5. Fungsi Destroy
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        
        if ($surat->file_path) {
            Storage::disk('public')->delete($surat->file_path);
        }
        
        $surat->delete();

        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dihapus permanen.');
    }
}