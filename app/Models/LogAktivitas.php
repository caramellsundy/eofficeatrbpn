<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogAktivitas extends Model
{
    use HasFactory;

    /**
     * Tentukan tabel jika nama tabel bukan bentuk jamak dari nama model
     * (Opsional: Jika nama tabel di database Anda adalah 'log_aktivitas')
     */
    protected $table = 'log_aktivitas';

    /**
     * Kolom yang dapat diisi
     */
    protected $fillable = [
        'user_id',
        'action',
        'description',
    ];

    /**
     * Relasi ke User (Satu log milik satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}