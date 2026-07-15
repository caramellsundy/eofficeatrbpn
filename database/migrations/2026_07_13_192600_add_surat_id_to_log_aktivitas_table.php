<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('log_aktivitas', 'surat_id')) {

            Schema::table('log_aktivitas', function (Blueprint $table) {

                $table->foreignId('surat_id')
                      ->nullable()
                      ->after('user_id')
                      ->constrained('surats')
                      ->nullOnDelete();

            });

        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('log_aktivitas', 'surat_id')) {

            Schema::table('log_aktivitas', function (Blueprint $table) {

                $table->dropForeign(['surat_id']);
                $table->dropColumn('surat_id');

            });

        }
    }
};
