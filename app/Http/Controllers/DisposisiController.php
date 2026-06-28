<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data surat yang perlu disposisi (bisa difilter berdasarkan status atau jenis)
        $query = Surat::query();

        // Fitur Pencarian
        if ($request->has('search')) {
            $query->where('perihal', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_surat', 'like', '%' . $request->search . '%');
        }

        $surats = $query->latest()->paginate(10);

        return view('disposisi.index', compact('surats'));
    }
}