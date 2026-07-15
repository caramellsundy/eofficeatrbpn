<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jabatan', function (Blueprint $table) {

            $table->string('kode')->nullable()->after('id');

            $table->text('deskripsi')->nullable()->after('nama');

        });
    }

    public function down(): void
    {
        Schema::table('jabatan', function (Blueprint $table) {

            $table->dropColumn([
                'kode',
                'deskripsi'
            ]);

        });
    }

};
