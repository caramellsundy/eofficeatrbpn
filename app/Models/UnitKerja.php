<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitKerja extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'unit_kerja';

    /**
     * Primary Key
     */
    protected $primaryKey = 'id';

    /**
     * Timestamp
     */
    public $timestamps = true;

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke Pegawai
     */
    public function pegawai()
    {
        return $this->hasMany(
            Pegawai::class,
            'unit_kerja_id',
            'id'
        );
    }
}