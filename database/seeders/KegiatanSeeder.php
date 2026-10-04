<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'nama_kegiatan' => 'Jamaah Subuh', 'jenis_jadwal' => 'harian', 'jam_mulai' => '08:00:00', 'jam_selesai' => '08:10:00', 'hari' => 'Kamis', 'status' => 'aktif', 'created_at' => '2026-06-12 04:27:20', 'updated_at' => '2026-08-26 18:00:02'],
            ['id' => 2, 'nama_kegiatan' => 'Jamaah Dzuhur', 'jenis_jadwal' => 'harian', 'jam_mulai' => '09:43:00', 'jam_selesai' => '09:53:00', 'hari' => 'Kamis', 'status' => 'aktif', 'created_at' => '2026-06-12 04:27:40', 'updated_at' => '2026-08-26 19:43:51'],
            ['id' => 3, 'nama_kegiatan' => 'Jamaah Ashar', 'jenis_jadwal' => 'harian', 'jam_mulai' => '16:09:00', 'jam_selesai' => '16:19:00', 'hari' => 'Rabu', 'status' => 'aktif', 'created_at' => '2026-06-12 04:28:12', 'updated_at' => '2026-08-12 02:09:37'],
            ['id' => 4, 'nama_kegiatan' => 'Ratibul Haddad', 'jenis_jadwal' => 'harian', 'jam_mulai' => '17:00:00', 'jam_selesai' => '17:30:00', 'hari' => 'Setiap Hari', 'status' => 'aktif', 'created_at' => '2026-06-12 04:29:33', 'updated_at' => '2026-09-02 22:58:03'],
            ['id' => 5, 'nama_kegiatan' => 'Jamaah Maghrib', 'jenis_jadwal' => 'harian', 'jam_mulai' => '17:45:00', 'jam_selesai' => '17:55:00', 'hari' => 'Senin', 'status' => 'aktif', 'created_at' => '2026-06-12 04:33:14', 'updated_at' => '2026-06-12 04:33:14'],
            ['id' => 6, 'nama_kegiatan' => 'Jamaah Isya\'', 'jenis_jadwal' => 'harian', 'jam_mulai' => '21:15:00', 'jam_selesai' => '21:25:00', 'hari' => 'Rabu', 'status' => 'aktif', 'created_at' => '2026-06-12 04:34:08', 'updated_at' => '2026-08-26 07:14:37'],
            ['id' => 7, 'nama_kegiatan' => 'Diba\'iyah', 'jenis_jadwal' => 'mingguan', 'jam_mulai' => '19:30:00', 'jam_selesai' => '20:00:00', 'hari' => 'Kamis', 'status' => 'aktif', 'created_at' => '2026-06-12 04:34:45', 'updated_at' => '2026-09-02 22:57:20'],
        ];

        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('kegiatans')->upsert($chunk, ['id'], ['nama_kegiatan', 'jenis_jadwal', 'jam_mulai', 'jam_selesai', 'hari', 'status', 'created_at', 'updated_at']);
        }
    }
}
