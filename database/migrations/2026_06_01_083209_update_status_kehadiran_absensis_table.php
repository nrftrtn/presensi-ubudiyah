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
        Schema::table('absensis', function (Blueprint $table) {

            // hapus kolom lama
            $table->dropColumn('status_kehadiran');
        });

        Schema::table('absensis', function (Blueprint $table) {

            // tambah status baru
            $table->enum('status_kehadiran', [
                'hadir',
                'terlambat',
                'alpha'
            ])->after('jam_absen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {

            $table->dropColumn('status_kehadiran');
        });

        Schema::table('absensis', function (Blueprint $table) {

            $table->enum('status_kehadiran', [
                'hadir',
                'terlambat',
                'alpha'
            ])->after('jam_absen');
        });
    }
};