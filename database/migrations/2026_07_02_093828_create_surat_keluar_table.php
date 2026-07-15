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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('tujuan_surat');
            $table->string('jenis');
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('penandatangan');
            $table->enum('status', [
                'Draft',
                'Menunggu Persetujuan',
                'Disetujui',
                'Terkirim'
            ])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};