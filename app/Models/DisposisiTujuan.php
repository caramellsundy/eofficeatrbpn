<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiTujuan extends Model
{
    use HasFactory;

    protected $table = 'disposisi_tujuans';

    protected $fillable = [
        'disposisi_id',
        'pegawai_id',
        'status',
        'dibaca_pada',
        'selesai_pada',
    ];

    protected $casts = [
        'dibaca_pada' => 'datetime',
        'selesai_pada' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    /**
     * Disposisi induk
     */
    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class, 'disposisi_id');
    }

    /**
     * Pegawai penerima disposisi
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    /**
     * Surat (shortcut melalui disposisi)
     */
    public function surat()
    {
        return $this->hasOneThrough(
            Surat::class,
            Disposisi::class,
            'id',          // Foreign key pada tabel disposisi
            'id',          // Foreign key pada tabel surats
            'disposisi_id',// Local key pada disposisi_tujuans
            'surat_id'     // Local key pada disposisi
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public function isBelumDibaca()
    {
        return $this->status === 'Belum Dibaca';
    }

    public function isSudahDibaca()
    {
        return $this->status === 'Sudah Dibaca';
    }

    public function isSelesai()
    {
        return $this->status === 'Selesai';
    }
}