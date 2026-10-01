<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan kolom jam masuk dan jam keluar
        Schema::table('absensis', function (Blueprint $table) {
            $table->time('jam_masuk')->nullable()->after('tanggal');
            $table->time('jam_keluar')->nullable()->after('jam_masuk');
        });

        // Pindahkan data jam_absen lama ke jam_masuk
        DB::statement("
            UPDATE absensis
            SET jam_masuk = jam_absen
            WHERE jam_absen IS NOT NULL
        ");

        // Hapus kolom jam_absen lama
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('jam_absen');
        });

        // Satu santri hanya boleh memiliki
        // satu absensi untuk satu kegiatan pada satu tanggal
        Schema::table('absensis', function (Blueprint $table) {
            $table->unique(
                ['santri_id', 'kegiatan_id', 'tanggal'],
                'absensis_santri_kegiatan_tanggal_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus unique constraint
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropUnique('absensis_santri_kegiatan_tanggal_unique');
        });

        // Kembalikan kolom jam_absen
        Schema::table('absensis', function (Blueprint $table) {
            $table->time('jam_absen')->nullable()->after('tanggal');
        });

        // Salin jam_masuk kembali ke jam_absen
        DB::statement("
            UPDATE absensis
            SET jam_absen = jam_masuk
            WHERE jam_masuk IS NOT NULL
        ");

        // Hapus kolom jam_masuk dan jam_keluar
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['jam_masuk', 'jam_keluar']);
        });
    }
};
