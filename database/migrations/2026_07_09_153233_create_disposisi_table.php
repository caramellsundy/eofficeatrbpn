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
        Schema::create('disposisi', function (Blueprint $table) {

            $table->id();

            // Surat yang didisposisikan
            $table->foreignId('surat_id')
                ->constrained('surats')
                ->cascadeOnDelete();

            // User/Admin pengirim disposisi
            $table->foreignId('pengirim_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('catatan');

            $table->enum('prioritas', [
                'Rendah',
                'Sedang',
                'Tinggi'
            ])->default('Sedang');

            $table->date('tanggal_disposisi');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};