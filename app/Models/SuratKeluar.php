<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'tujuan_surat',
        'jenis',
        'perihal',
        'tanggal_surat',
        'penandatangan',
        'status',
    ];
}