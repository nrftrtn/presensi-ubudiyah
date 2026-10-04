<?php

namespace Database\Seeders;

use App\Models\PengaturanShalat;
use Illuminate\Database\Seeder;

class PengaturanShalatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
