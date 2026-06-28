<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom yang boleh diisi melalui Mass Assignment
     */
    protected $fillable = [
        'user_id', 
        'jenis_surat', 
        'kode_surat', 
        'nomor_surat', 
        'nomor_agenda', 
        'judul_surat', 
        'metode', 
        'asal_surat', 
        'tanggal_surat',
        'tanggal_terima', // Pastikan kolom ini sudah ada di database
        'status', 
        'kantor_id', 
        'tahun', 
        'perihal',        // Sudah ditambahkan
        'is_priority'     // Tambahan untuk fitur filter prioritas
    ];

    /**
     * Relasi: Satu surat bisa memiliki banyak disposisi
     */
    public function disposisiTujuans() 
    {
        return $this->hasMany(DisposisiTujuan::class);
    }

    /**
     * Relasi: Satu surat memiliki banyak log aktivitas
     */
    public function logs() 
    {
        return $this->hasMany(SuratLog::class);
    }
}