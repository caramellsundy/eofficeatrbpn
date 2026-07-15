<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->enum('jenis_surat', [
                'masuk',
                'keluar',
                'disposisi'
            ]);

            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');

            $table->string('nomor_agenda')->nullable();
            $table->string('kode_surat')->nullable();

            $table->string('judul_surat')->nullable();
            $table->string('perihal')->nullable();

            $table->string('asal_surat')->nullable();
            $table->string('tujuan_surat')->nullable();

            $table->string('metode')->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('file_path')->nullable();

            $table->boolean('is_priority')->default(false);

            $table->enum('status', [
                'menunggu',
                'diproses',
                'selesai',
                'ditolak'
            ])->default('menunggu');

            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};