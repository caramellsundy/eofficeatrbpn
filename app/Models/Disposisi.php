<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposisi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surat_id', 
        'dari_pejabat', 
        'kepada_petugas', 
        'instruksi', 
        'status', 
        'batas_waktu'
    ];

    /**
     * The attributes that should be cast.
     * Ini memastikan batas_waktu otomatis dikonversi menjadi instance Carbon (DateTime).
     */
    protected $casts = [
        'batas_waktu' => 'datetime',
    ];

    /**
     * Relasi ke model Surat.
     * Satu disposisi pasti milik satu surat.
     */
    public function surat(): BelongsTo
    {
        return $this->belongsTo(Surat::class);
    }
}