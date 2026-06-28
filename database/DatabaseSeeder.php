<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Surat;
use App\Models\Disposisi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bersihkan tabel agar data tidak menumpuk saat dijalankan berulang
        \DB::table('disposisis')->truncate();
        \DB::table('surats')->truncate();
        \DB::table('users')->truncate();

        // 2. Buat User Admin (Pegawai)
        $admin = User::create([
            'name' => 'Administrator E-Office',
            'email' => 'admin@atrbpn.go.id',
            'password' => Hash::make('password123'),
            'role' => 'admin', // Saya ubah jadi admin agar bisa akses semua fitur
            'nip' => '198001012005011001',
            'jabatan' => 'Kepala Seksi Persuratan',
        ]);

        // 3. Buat User dummy tambahan
        User::factory()->count(3)->create();

        // 4. Mengisi data Surat menggunakan Factory
        // Pastikan Anda sudah menjalankan 'php artisan make:factory SuratFactory'
        Surat::factory()->count(15)->create(['user_id' => $admin->id])->each(function ($surat) {
            Disposisi::create([
                'surat_id' => $surat->id,
                'dari_pejabat' => 'Kepala Kantor Pertanahan',
                'kepada_petugas' => 'Petugas Pelayanan ' . fake()->numberBetween(1, 5),
                'instruksi' => fake()->sentence(),
                'status' => fake()->randomElement(['proses', 'selesai']),
            ]);
        });

        $this->command->info('Database berhasil diisi dengan data dummy!');
    }
}