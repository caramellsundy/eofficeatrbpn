<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surats';

    protected $fillable = [

        'user_id',

        'jenis_surat',

        'nomor_surat',
        'tanggal_surat',
        'tanggal_keluar',
        'tanggal_kirim',

        'nomor_agenda',
        'kode_surat',

        'judul_surat',
        'perihal',
        'lampiran',

        'asal_surat',
        'tujuan_surat',

        'penandatangan',

        'metode',
        'deskripsi',

        'file_path',

        'is_priority',

        'status',
        'catatan_admin',

        'jabatan_pimpinan_id',
        'nama_pimpinan',

        'diteruskan_oleh',
        'diteruskan_pada',
        'catatan_pengantar',
        'metode_penerusan',

    ];

    protected $casts = [

        'tanggal_surat'  => 'date',
        'tanggal_keluar' => 'date',
        'tanggal_kirim'  => 'date',

        'is_priority'    => 'boolean',
        'diteruskan_pada' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    /**
     * User pembuat surat
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Semua disposisi surat
     */
    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'surat_id');
    }

    /**
     * Semua log aktivitas surat
     */
    public function logs()
    {
        return $this->hasMany(LogAktivitas::class, 'surat_id')
                    ->latest();
    }

    /**
 * Semua tujuan disposisi surat
 */
public function disposisiTujuans()
{
    return $this->hasManyThrough(
        DisposisiTujuan::class,
        Disposisi::class,
        'surat_id',
        'disposisi_id',
        'id',
        'id'
    );
}

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    /**
     * Badge Bootstrap berdasarkan status
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {

            'menunggu'  => 'warning',

            'draft' => 'secondary',
            'diajukan' => 'warning',
            'diverifikasi' => 'success',
            'dikembalikan' => 'danger',
            'diteruskan_ke_pimpinan' => 'primary',
            'terkirim' => 'info',
            'diarsipkan' => 'dark',

            'disetujui' => 'success',

            'diproses'  => 'info',

            'selesai'   => 'primary',

            'ditolak'   => 'danger',

            default => 'secondary',
        };
    }


    public function jabatanPimpinan()
{
    return $this->belongsTo(Jabatan::class,'jabatan_pimpinan_id');
}

    public function penerus()
    {
        return $this->belongsTo(User::class, 'diteruskan_oleh');
    }
    /**
     * Label status
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'draft' => 'Draft',
            'diajukan' => 'Diajukan ke Admin',
            'diverifikasi' => 'Diverifikasi Admin',
            'dikembalikan' => 'Dikembalikan untuk Perbaikan',
            'diteruskan_ke_pimpinan' => 'Diteruskan ke Pimpinan',
            'terkirim' => 'Terkirim',
            'diarsipkan' => 'Diarsipkan',
            'selesai' => 'Selesai',
            default => ucwords(str_replace('_', ' ', $this->status ?? '-')),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPE
    |--------------------------------------------------------------------------
    */

    /**
     * Surat masuk
     */
    public function scopeMasuk($query)
    {
        return $query->where('jenis_surat', 'masuk');
    }

    /**
     * Surat keluar
     */
    public function scopeKeluar($query)
    {
        return $query->where('jenis_surat', 'keluar');
    }

    /**
     * Berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Berdasarkan user
     */
    public function scopeMilikUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
