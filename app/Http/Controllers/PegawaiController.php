<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
{
    // Mengarah ke resources/views/dashboard/pegawai.blade.php
    return view('dashboard.pegawai'); 
}
}