<?php



namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    //
     public function index()
{
    // Mengarah ke resources/views/dashboard/pegawai.blade.php
    return view('dashboard.pegawai'); 
}

}