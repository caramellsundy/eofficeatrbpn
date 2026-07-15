<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        Jabatan::query()->delete();

        $jabatan = [
            ['nama' => 'Kepala Kantor'],
            ['nama' => 'Sekretaris'],
            ['nama' => 'Kepala Subbagian'],
            ['nama' => 'Analis Pertanahan'],
            ['nama' => 'Staf Administrasi'],
        ];

        foreach ($jabatan as $item) {
            Jabatan::create($item);
        }

        $this->command->info('Jabatan berhasil ditambahkan: '.Jabatan::count());
    }
}