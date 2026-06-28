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
    Schema::table('surats', function (Blueprint $table) {
        $table->string('kode_surat')->nullable()->change();
        $table->string('judul_surat')->nullable()->change();
        $table->string('metode')->nullable()->change();
        $table->string('asal_surat')->nullable()->change();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            //
        });
    }
};
