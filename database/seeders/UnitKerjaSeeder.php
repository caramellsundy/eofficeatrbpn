<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        UnitKerja::query()->delete();

        $unit = [
            ['nama' => 'Sekretariat'],
            ['nama' => 'Subbagian Tata Usaha'],
            ['nama' => 'Seksi Penetapan Hak'],
            ['nama' => 'Seksi Survei dan Pemetaan'],
            ['nama' => 'Seksi Pengadaan Tanah'],
        ];

        foreach ($unit as $item) {
            UnitKerja::create($item);
        }

        $this->command->info('Unit Kerja berhasil ditambahkan: '.UnitKerja::count());
    }
}