<?php

namespace Database\Seeders;

use App\Models\User;
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
        // 1. Akun Admin Default (User admin bawaan)
        User::firstOrCreate(
            ['email' => 'admin@sipuda.com'],
            [
                'name' => 'Administrator SIPUDA',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Panggil Seeder Terpisah Berdasarkan database/presensi-ubudiyah.sql
        $this->call([
            KamarSeeder::class,
            KegiatanSeeder::class,
            SantriSeeder::class,
            AbsensiSeeder::class,
            PengaturanShalatSeeder::class,
        ]);
    }
}
