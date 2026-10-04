<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'nama_kamar' => 'A1', 'blok' => 'BLOK A', 'kapasitas' => null, 'created_at' => '2026-06-12 04:20:53', 'updated_at' => '2026-06-12 04:20:53'],
            ['id' => 2, 'nama_kamar' => 'A2', 'blok' => 'BLOK A', 'kapasitas' => null, 'created_at' => '2026-06-12 04:21:07', 'updated_at' => '2026-06-12 04:21:07'],
            ['id' => 3, 'nama_kamar' => 'A3', 'blok' => 'BLOK A', 'kapasitas' => null, 'created_at' => '2026-06-12 04:21:16', 'updated_at' => '2026-06-12 04:21:16'],
            ['id' => 4, 'nama_kamar' => 'A4', 'blok' => 'BLOK A', 'kapasitas' => null, 'created_at' => '2026-06-12 04:21:33', 'updated_at' => '2026-06-12 04:21:33'],
            ['id' => 6, 'nama_kamar' => 'B1', 'blok' => 'BLOK B', 'kapasitas' => null, 'created_at' => '2026-06-12 04:21:46', 'updated_at' => '2026-06-12 04:21:46'],
            ['id' => 7, 'nama_kamar' => 'B2', 'blok' => 'BLOK B', 'kapasitas' => null, 'created_at' => '2026-06-12 04:21:56', 'updated_at' => '2026-06-12 04:21:56'],
            ['id' => 8, 'nama_kamar' => 'B3', 'blok' => 'BLOK B', 'kapasitas' => null, 'created_at' => '2026-06-12 04:22:11', 'updated_at' => '2026-06-12 04:22:11'],
            ['id' => 9, 'nama_kamar' => 'B4', 'blok' => 'BLOK B', 'kapasitas' => null, 'created_at' => '2026-06-12 04:22:26', 'updated_at' => '2026-06-12 04:22:26'],
            ['id' => 10, 'nama_kamar' => 'C1', 'blok' => 'BLOK C', 'kapasitas' => null, 'created_at' => '2026-06-12 04:23:48', 'updated_at' => '2026-06-12 04:23:48'],
            ['id' => 11, 'nama_kamar' => 'C2', 'blok' => 'BLOK C', 'kapasitas' => null, 'created_at' => '2026-06-12 04:24:05', 'updated_at' => '2026-06-12 04:24:05'],
            ['id' => 12, 'nama_kamar' => 'C3', 'blok' => 'BLOK C', 'kapasitas' => null, 'created_at' => '2026-06-12 04:24:23', 'updated_at' => '2026-06-12 04:24:23'],
            ['id' => 13, 'nama_kamar' => 'D1', 'blok' => 'BLOK D', 'kapasitas' => null, 'created_at' => '2026-06-12 04:24:48', 'updated_at' => '2026-06-12 04:24:48'],
            ['id' => 14, 'nama_kamar' => 'D2', 'blok' => 'BLOK D', 'kapasitas' => null, 'created_at' => '2026-06-12 04:25:03', 'updated_at' => '2026-06-12 04:25:03'],
            ['id' => 15, 'nama_kamar' => 'D3', 'blok' => 'BLOK D', 'kapasitas' => null, 'created_at' => '2026-06-12 04:25:20', 'updated_at' => '2026-06-12 04:25:20'],
            ['id' => 16, 'nama_kamar' => 'PONDOK BAWAH', 'blok' => 'BLOK BAWAH', 'kapasitas' => null, 'created_at' => '2026-06-12 04:25:32', 'updated_at' => '2026-06-12 04:25:32'],
        ];

        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('kamars')->upsert($chunk, ['id'], ['nama_kamar', 'blok', 'kapasitas', 'created_at', 'updated_at']);
        }
    }
}
