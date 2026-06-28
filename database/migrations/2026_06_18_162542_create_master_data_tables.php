<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // Tabel Unit Kerja
    Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->string('nama_unit'); // Contoh: Biro Umum
        $table->timestamps();
    });

    // Tabel Pegawai (sudah termasuk Jabatan dan relasi ke Unit)
    Schema::create('pegawais', function (Blueprint $table) {
        $table->id();
        $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
        $table->string('nama_pegawai');
        $table->string('jabatan'); // Contoh: Kepala Biro
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('pegawais');
    Schema::dropIfExists('units');
}
};
