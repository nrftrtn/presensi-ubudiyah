<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kamar;
use App\Models\Kegiatan;
use App\Models\PengaturanShalat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Default
        User::firstOrCreate(
            ['email' => 'admin@sipuda.com'],
            [
                'name' => 'Administrator SIPUDA',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Kamar Bawaan
        $kamars = [
            ['nama_kamar' => 'Kamar Abu Bakar', 'blok' => 'A', 'kapasitas' => 10],
            ['nama_kamar' => 'Kamar Umar bin Khattab', 'blok' => 'A', 'kapasitas' => 10],
            ['nama_kamar' => 'Kamar Utsman bin Affan', 'blok' => 'B', 'kapasitas' => 10],
            ['nama_kamar' => 'Kamar Ali bin Abi Thalib', 'blok' => 'B', 'kapasitas' => 10],
        ];

        foreach ($kamars as $kamar) {
            Kamar::firstOrCreate(
                ['nama_kamar' => $kamar['nama_kamar']],
                $kamar
            );
        }

        // 3. Kegiatan Shalat 5 Waktu
        $shalats = [
            ['nama_kegiatan' => 'Shalat Subuh', 'jam_mulai' => '04:00:00', 'jam_selesai' => '04:30:00'],
            ['nama_kegiatan' => 'Shalat Dzuhur', 'jam_mulai' => '11:30:00', 'jam_selesai' => '12:00:00'],
            ['nama_kegiatan' => 'Shalat Ashar', 'jam_mulai' => '14:30:00', 'jam_selesai' => '15:00:00'],
            ['nama_kegiatan' => 'Shalat Maghrib', 'jam_mulai' => '17:30:00', 'jam_selesai' => '18:00:00'],
            ['nama_kegiatan' => 'Shalat Isya', 'jam_mulai' => '18:30:00', 'jam_selesai' => '19:30:00'],
        ];

        foreach ($shalats as $shalat) {
            Kegiatan::firstOrCreate(
                ['nama_kegiatan' => $shalat['nama_kegiatan']],
                [
                    'jenis_jadwal' => 'harian',
                    'jam_mulai' => $shalat['jam_mulai'],
                    'jam_selesai' => $shalat['jam_selesai'],
                    'hari' => 'Semua',
                    'status' => 'aktif',
                ]
            );
        }

        // 4. Pengaturan Shalat (Toleransi & Jeda)
        $pengaturan = [
            'subuh' => ['label' => 'Shalat Subuh', 'delay' => 10, 'toleransi' => 3, 'durasi' => 7],
            'dzuhur' => ['label' => 'Shalat Dzuhur', 'delay' => 10, 'toleransi' => 2, 'durasi' => 5],
            'ashar' => ['label' => 'Shalat Ashar', 'delay' => 10, 'toleransi' => 2, 'durasi' => 5],
            'maghrib' => ['label' => 'Shalat Maghrib', 'delay' => 10, 'toleransi' => 2, 'durasi' => 5],
            'isya' => ['label' => 'Shalat Isya', 'delay' => 10, 'toleransi' => 2, 'durasi' => 5],
        ];

        foreach ($pengaturan as $nama => $data) {
            PengaturanShalat::firstOrCreate(
                ['nama_shalat' => $nama],
                [
                    'label' => $data['label'],
                    'delay_adzan_menit' => $data['delay'],
                    'toleransi_hadir_menit' => $data['toleransi'],
                    'durasi_jendela_menit' => $data['durasi'],
                    'status_aktif' => true,
                ]
            );
        }
    }
}
