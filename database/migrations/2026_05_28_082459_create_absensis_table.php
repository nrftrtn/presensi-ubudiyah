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
        Schema::create('absensis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('santri_id')
                  ->constrained('santris')
                  ->onDelete('cascade');

            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatans')
                  ->onDelete('cascade');

            $table->date('tanggal');

            $table->time('jam_absen');

            $table->enum('status_kehadiran', [
                'hadir',
                'terlambat',
                'alpha'
            ]);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};