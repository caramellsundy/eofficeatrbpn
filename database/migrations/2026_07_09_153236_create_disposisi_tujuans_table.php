<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disposisi_tujuans', function (Blueprint $table) {

            $table->id();

            // Relasi ke disposisi
            $table->foreignId('disposisi_id')
                ->constrained('disposisi')
                ->cascadeOnDelete();

            // Pegawai tujuan
            $table->foreignId('pegawai_id')
                ->constrained('pegawai')
                ->cascadeOnDelete();

            $table->enum('status', [
                'Belum Dibaca',
                'Sudah Dibaca',
                'Selesai'
            ])->default('Belum Dibaca');

            $table->timestamp('dibaca_pada')->nullable();

            $table->timestamp('selesai_pada')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi_tujuans');
    }
};