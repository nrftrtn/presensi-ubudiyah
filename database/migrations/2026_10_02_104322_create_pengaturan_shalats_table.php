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
        Schema::create('pengaturan_shalats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_shalat')->unique();
            $table->string('label');
            $table->unsignedInteger('delay_adzan_menit')->default(10);
            $table->unsignedInteger('toleransi_hadir_menit')->default(2);
            $table->unsignedInteger('durasi_jendela_menit')->default(5);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });

        // Insert konfigurasi default
        DB::table('pengaturan_shalats')->insert([
            [
                'nama_shalat' => 'subuh',
                'label' => 'Shalat Subuh',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 3,
                'durasi_jendela_menit' => 7,
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_shalat' => 'dzuhur',
                'label' => 'Shalat Dzuhur',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 2,
                'durasi_jendela_menit' => 5,
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_shalat' => 'ashar',
                'label' => 'Shalat Ashar',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 2,
                'durasi_jendela_menit' => 5,
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_shalat' => 'maghrib',
                'label' => 'Shalat Maghrib',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 2,
                'durasi_jendela_menit' => 5,
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_shalat' => 'isya',
                'label' => 'Shalat Isya',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 2,
                'durasi_jendela_menit' => 5,
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_shalats');
    }
};
