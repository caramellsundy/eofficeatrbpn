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
    Schema::create('surats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('nomor_surat');
        $table->string('judul_surat');
        $table->date('tanggal_surat');
        $table->string('status')->default('proses');
        $table->string('kantor_id')->nullable();
        $table->string('tahun')->default('2026');
        $table->timestamps();
    });
}
};
