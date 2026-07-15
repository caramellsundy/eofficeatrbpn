<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@atrbpn.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pegawai@atrbpn.com'],
            [
                'name' => 'Pegawai',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
            ]
        );

        User::updateOrCreate(
            ['email' => 'umum@atrbpn.com'],
            [
                'name' => 'Masyarakat',
                'password' => Hash::make('password'),
                'role' => 'umum',
            ]
        );

        $this->call([
            JabatanSeeder::class,
            UnitKerjaSeeder::class,
            PegawaiSeeder::class,
            SuratSeeder::class,
            DisposisiSeeder::class,
        ]);
    }
}