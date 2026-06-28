<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Pintu masuk utama (route: /dashboard)
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->hasRole('pegawai')) {
            return redirect()->route('pegawai.dashboard');
        } 
        
        return redirect()->route('dashboard.umum'); 
    }

    public function umumIndex() 
    {
        $surats = Surat::where('user_id', Auth::id())->latest()->paginate(10);
        return view('umum.dashboard', compact('surats'));
    }

    public function pegawaiIndex() 
    {
        return view('pegawai.dashboard'); 
    }

    /**
     * Admin Dashboard
     */
    public function adminIndex()
    {
        $totalSurat = Surat::count();
        $suratSelesai = Surat::where('status', 'approved')->count();
        
        // Logika status baru (pending atau ditinjau)
        $suratBaru = Surat::whereIn('status', ['pending', 'ditinjau'])->count();
        
        $data = [
            'totalSurat'        => $totalSurat,
            'totalUser'         => User::count(),
            'suratBaru'         => $suratBaru, 
            'persentaseSelesai' => $totalSurat > 0 ? round(($suratSelesai / $totalSurat) * 100) : 0,
            'persentaseUser'    => 60, 
            
            // Menggunakan with('user') untuk mencegah N+1 query issue saat menampilkan nama user di view
            'logs'              => LogAktivitas::with('user')->latest()->take(5)->get(),
            
            // Mengambil 5 surat terbaru agar list tidak terlalu kosong
            'latestSurats'      => Surat::latest()->take(5)->get(),
        ];

        // Perubahan dilakukan di sini agar sesuai dengan struktur folder views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('data'));
    }
}