<?php

namespace Database\Factories;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuratFactory extends Factory
{
    protected $model = Surat::class;

    public function definition(): array
    {
        // Mendapatkan array jenis surat untuk randomisasi
        $jenis = ['masuk', 'keluar', 'pengantar', 'inisiatif'];

        return [
            'nomor_surat' => fake()->unique()->bothify('BPN/??/####/2026'),
            'judul_surat' => fake()->sentence(4),
            'jenis_surat' => fake()->randomElement($jenis),
            'asal_instansi' => fake()->company(),
            'tujuan_instansi' => fake()->company(),
            'tanggal_surat' => fake()->dateTimeBetween('-1 month', 'now'),
            'tanggal_diterima' => fake()->dateTimeBetween('-1 month', 'now'),
            'ringkasan_isi' => fake()->paragraph(),
            'file_surat' => 'default_dokumen.pdf',
            
            // Mengambil ID user secara acak agar data tersebar merata
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
        ];
    }
    
    // State khusus untuk surat masuk agar lebih mudah dipanggil di Seeder
    public function masuk(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'jenis_surat' => 'masuk',
        ]);
    }
}