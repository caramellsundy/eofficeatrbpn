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
    Schema::create('disposisi_tujuans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('surat_id')->constrained()->onDelete('cascade');
        $table->string('unit_kerja');
        $table->string('jabatan');
        $table->string('pegawai');
        $table->timestamps();
    });
}
};
