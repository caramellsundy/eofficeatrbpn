<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {

            $table->date('tanggal_kirim')
                  ->nullable()
                  ->after('tanggal_surat');

            $table->date('tanggal_keluar')
                  ->nullable()
                  ->after('tanggal_kirim');

            $table->string('penandatangan')
                  ->nullable()
                  ->after('tujuan_surat');

        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal_kirim',
                'tanggal_keluar',
                'penandatangan'
            ]);

        });
    }
};