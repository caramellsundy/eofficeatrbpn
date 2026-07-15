<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disposisi;

class DisposisiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Disposisi::query()->delete();

        $data = [
            [
                'surat_id' => 1,
                'pengirim_id' => 2,
                'catatan' => 'Segera diproses oleh bagian tata usaha.',
                'prioritas' => 'tinggi',
                'tanggal_disposisi' => now(),
            ],
            [
                'surat_id' => 2,
                'pengirim_id' => 2,
                'catatan' => 'Pelajari isi surat dan buat balasan.',
                'prioritas' => 'sedang',
                'tanggal_disposisi' => now()->subDay(),
            ],
            [
                'surat_id' => 3,
                'pengirim_id' => 2,
                'catatan' => 'Arsipkan setelah selesai.',
                'prioritas' => 'rendah',
                'tanggal_disposisi' => now()->subDays(2),
            ],
        ];

        foreach ($data as $item) {
            Disposisi::create($item);
        }

        $this->command->info(
            'Disposisi berhasil ditambahkan: '.Disposisi::count()
        );
    }
}