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
        $table->string('metode')->nullable();
        $table->string('kode_surat')->nullable();
        $table->string('asal_surat')->nullable();
    });
}
};
