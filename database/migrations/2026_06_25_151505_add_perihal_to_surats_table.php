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
    Schema::table('surats', function (Blueprint $table) {
        // Tambahkan kolom perihal (bisa disesuaikan tipe datanya, misal text jika panjang)
        $table->text('perihal')->nullable()->after('nomor_surat');
    });
}

public function down(): void
{
    Schema::table('surats', function (Blueprint $table) {
        $table->dropColumn('perihal');
    });
}
};
