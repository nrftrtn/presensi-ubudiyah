<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'santri_id' => 1, 'kegiatan_id' => 6, 'tanggal' => '2026-06-12', 'jam_masuk' => '18:40:00', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-06-12 04:37:48', 'updated_at' => '2026-06-12 04:37:48'],
            ['id' => 2, 'santri_id' => 2, 'kegiatan_id' => 6, 'tanggal' => '2026-06-12', 'jam_masuk' => '18:48:00', 'jam_keluar' => null, 'status_kehadiran' => 'terlambat', 'created_at' => '2026-06-12 04:48:40', 'updated_at' => '2026-06-12 04:48:40'],
            ['id' => 3, 'santri_id' => 1, 'kegiatan_id' => 1, 'tanggal' => '2026-06-12', 'jam_masuk' => '11:54:12', 'jam_keluar' => null, 'status_kehadiran' => 'terlambat', 'created_at' => '2026-06-12 04:54:12', 'updated_at' => '2026-06-12 04:54:12'],
            ['id' => 4, 'santri_id' => 2, 'kegiatan_id' => 1, 'tanggal' => '2026-06-12', 'jam_masuk' => '11:54:27', 'jam_keluar' => null, 'status_kehadiran' => 'terlambat', 'created_at' => '2026-06-12 04:54:27', 'updated_at' => '2026-06-12 04:54:27'],
            ['id' => 5, 'santri_id' => 17, 'kegiatan_id' => 3, 'tanggal' => '2026-06-29', 'jam_masuk' => '14:23:48', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-06-29 00:23:48', 'updated_at' => '2026-06-29 00:23:48'],
            ['id' => 6, 'santri_id' => 16, 'kegiatan_id' => 4, 'tanggal' => '2026-06-29', 'jam_masuk' => '14:46:24', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-06-29 00:46:24', 'updated_at' => '2026-06-29 00:46:24'],
            ['id' => 7, 'santri_id' => 15, 'kegiatan_id' => 4, 'tanggal' => '2026-06-29', 'jam_masuk' => '14:49:38', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-06-29 00:49:38', 'updated_at' => '2026-06-29 00:49:38'],
            ['id' => 8, 'santri_id' => 1, 'kegiatan_id' => 1, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:41:07', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:41:07', 'updated_at' => '2026-08-10 18:41:07'],
            ['id' => 9, 'santri_id' => 11, 'kegiatan_id' => 1, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:41:51', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:41:51', 'updated_at' => '2026-08-10 18:41:51'],
            ['id' => 10, 'santri_id' => 7, 'kegiatan_id' => 1, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:42:12', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:42:12', 'updated_at' => '2026-08-10 18:42:12'],
            ['id' => 11, 'santri_id' => 9, 'kegiatan_id' => 1, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:42:32', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:42:33', 'updated_at' => '2026-08-10 18:42:33'],
            ['id' => 12, 'santri_id' => 21, 'kegiatan_id' => 1, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:44:15', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:44:15', 'updated_at' => '2026-08-10 18:44:15'],
            ['id' => 13, 'santri_id' => 5, 'kegiatan_id' => 1, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:44:53', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:44:53', 'updated_at' => '2026-08-10 18:44:53'],
            ['id' => 14, 'santri_id' => 5, 'kegiatan_id' => 2, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:55:08', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:55:08', 'updated_at' => '2026-08-10 18:55:08'],
            ['id' => 15, 'santri_id' => 13, 'kegiatan_id' => 2, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:55:40', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:55:40', 'updated_at' => '2026-08-10 18:55:40'],
            ['id' => 16, 'santri_id' => 3, 'kegiatan_id' => 2, 'tanggal' => '2026-08-11', 'jam_masuk' => '08:58:08', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 18:58:08', 'updated_at' => '2026-08-10 18:58:08'],
            ['id' => 17, 'santri_id' => 7, 'kegiatan_id' => 2, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:43:21', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:43:21', 'updated_at' => '2026-08-10 20:43:21'],
            ['id' => 18, 'santri_id' => 9, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:08', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:08', 'updated_at' => '2026-08-10 20:45:08'],
            ['id' => 19, 'santri_id' => 3, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:14', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:14', 'updated_at' => '2026-08-10 20:45:14'],
            ['id' => 20, 'santri_id' => 1, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:24', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:24', 'updated_at' => '2026-08-10 20:45:24'],
            ['id' => 21, 'santri_id' => 7, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:30', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:30', 'updated_at' => '2026-08-10 20:45:30'],
            ['id' => 22, 'santri_id' => 5, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:36', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:36', 'updated_at' => '2026-08-10 20:45:36'],
            ['id' => 23, 'santri_id' => 13, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:43', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:44', 'updated_at' => '2026-08-10 20:45:44'],
            ['id' => 24, 'santri_id' => 11, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:52', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:52', 'updated_at' => '2026-08-10 20:45:52'],
            ['id' => 25, 'santri_id' => 21, 'kegiatan_id' => 3, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:45:57', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:45:57', 'updated_at' => '2026-08-10 20:45:57'],
            ['id' => 26, 'santri_id' => 21, 'kegiatan_id' => 4, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:50:35', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:50:35', 'updated_at' => '2026-08-10 20:50:35'],
            ['id' => 27, 'santri_id' => 9, 'kegiatan_id' => 4, 'tanggal' => '2026-08-11', 'jam_masuk' => '10:50:45', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-10 20:50:45', 'updated_at' => '2026-08-10 20:50:45'],
            ['id' => 28, 'santri_id' => 11, 'kegiatan_id' => 1, 'tanggal' => '2026-08-12', 'jam_masuk' => '09:55:20', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 19:55:20', 'updated_at' => '2026-08-11 19:55:20'],
            ['id' => 29, 'santri_id' => 9, 'kegiatan_id' => 1, 'tanggal' => '2026-08-12', 'jam_masuk' => '09:56:29', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 19:56:29', 'updated_at' => '2026-08-11 19:56:29'],
            ['id' => 30, 'santri_id' => 7, 'kegiatan_id' => 1, 'tanggal' => '2026-08-12', 'jam_masuk' => '10:25:02', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 20:25:02', 'updated_at' => '2026-08-11 20:25:02'],
            ['id' => 31, 'santri_id' => 13, 'kegiatan_id' => 1, 'tanggal' => '2026-08-12', 'jam_masuk' => '10:25:50', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 20:25:50', 'updated_at' => '2026-08-11 20:25:50'],
            ['id' => 32, 'santri_id' => 11, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '10:50:00', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 20:50:00', 'updated_at' => '2026-08-11 20:50:00'],
            ['id' => 33, 'santri_id' => 21, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '10:50:01', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 20:50:01', 'updated_at' => '2026-08-11 20:50:01'],
            ['id' => 34, 'santri_id' => 5, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '10:54:01', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 20:54:01', 'updated_at' => '2026-08-11 20:54:01'],
            ['id' => 35, 'santri_id' => 1, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '10:57:19', 'jam_keluar' => null, 'status_kehadiran' => 'terlambat', 'created_at' => '2026-08-11 20:57:19', 'updated_at' => '2026-08-11 20:57:19'],
            ['id' => 36, 'santri_id' => 3, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '11:14:44', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 21:14:44', 'updated_at' => '2026-08-11 21:14:44'],
            ['id' => 37, 'santri_id' => 13, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '11:15:36', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-11 21:15:36', 'updated_at' => '2026-08-11 21:15:36'],
            ['id' => 38, 'santri_id' => 7, 'kegiatan_id' => 2, 'tanggal' => '2026-08-12', 'jam_masuk' => '11:20:00', 'jam_keluar' => null, 'status_kehadiran' => 'terlambat', 'created_at' => '2026-08-11 21:20:00', 'updated_at' => '2026-08-11 21:20:00'],
            ['id' => 39, 'santri_id' => 3, 'kegiatan_id' => 3, 'tanggal' => '2026-08-12', 'jam_masuk' => '16:13:30', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-12 02:13:30', 'updated_at' => '2026-08-12 02:13:30'],
            ['id' => 40, 'santri_id' => 11, 'kegiatan_id' => 3, 'tanggal' => '2026-08-12', 'jam_masuk' => '16:13:33', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-12 02:13:33', 'updated_at' => '2026-08-12 02:13:33'],
            ['id' => 41, 'santri_id' => 1, 'kegiatan_id' => 3, 'tanggal' => '2026-08-12', 'jam_masuk' => '16:13:51', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-12 02:13:51', 'updated_at' => '2026-08-12 02:13:51'],
            ['id' => 42, 'santri_id' => 3, 'kegiatan_id' => 1, 'tanggal' => '2026-08-19', 'jam_masuk' => '06:32:06', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-18 16:32:07', 'updated_at' => '2026-08-18 16:32:07'],
            ['id' => 43, 'santri_id' => 11, 'kegiatan_id' => 1, 'tanggal' => '2026-08-19', 'jam_masuk' => '06:32:23', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-18 16:32:23', 'updated_at' => '2026-08-18 16:32:23'],
            ['id' => 44, 'santri_id' => 7, 'kegiatan_id' => 2, 'tanggal' => '2026-08-19', 'jam_masuk' => '07:46:08', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-18 17:46:08', 'updated_at' => '2026-08-18 17:46:08'],
            ['id' => 45, 'santri_id' => 11, 'kegiatan_id' => 2, 'tanggal' => '2026-08-19', 'jam_masuk' => '07:46:27', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-18 17:46:27', 'updated_at' => '2026-08-18 17:46:27'],
            ['id' => 46, 'santri_id' => 3, 'kegiatan_id' => 2, 'tanggal' => '2026-08-19', 'jam_masuk' => '07:46:47', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-18 17:46:47', 'updated_at' => '2026-08-18 17:46:47'],
            ['id' => 47, 'santri_id' => 5, 'kegiatan_id' => 6, 'tanggal' => '2026-08-26', 'jam_masuk' => '20:53:41', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 06:53:41', 'updated_at' => '2026-08-26 06:53:41'],
            ['id' => 48, 'santri_id' => 11, 'kegiatan_id' => 6, 'tanggal' => '2026-08-26', 'jam_masuk' => '21:01:05', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 07:01:05', 'updated_at' => '2026-08-26 07:01:05'],
            ['id' => 49, 'santri_id' => 1, 'kegiatan_id' => 6, 'tanggal' => '2026-08-26', 'jam_masuk' => '21:15:28', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 07:15:28', 'updated_at' => '2026-08-26 07:15:28'],
            ['id' => 50, 'santri_id' => 7, 'kegiatan_id' => 6, 'tanggal' => '2026-08-26', 'jam_masuk' => '21:18:54', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 07:18:54', 'updated_at' => '2026-08-26 07:18:54'],
            ['id' => 51, 'santri_id' => 13, 'kegiatan_id' => 1, 'tanggal' => '2026-08-27', 'jam_masuk' => '08:00:18', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 18:00:18', 'updated_at' => '2026-08-26 18:00:18'],
            ['id' => 52, 'santri_id' => 1, 'kegiatan_id' => 2, 'tanggal' => '2026-08-27', 'jam_masuk' => '09:45:02', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 19:45:02', 'updated_at' => '2026-08-26 19:45:02'],
            ['id' => 53, 'santri_id' => 21, 'kegiatan_id' => 2, 'tanggal' => '2026-08-27', 'jam_masuk' => '09:45:32', 'jam_keluar' => null, 'status_kehadiran' => 'hadir', 'created_at' => '2026-08-26 19:45:32', 'updated_at' => '2026-08-26 19:45:32'],
        ];

        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('absensis')->upsert($chunk, ['id'], ['santri_id', 'kegiatan_id', 'tanggal', 'jam_masuk', 'jam_keluar', 'status_kehadiran', 'created_at', 'updated_at']);
        }
    }
}
