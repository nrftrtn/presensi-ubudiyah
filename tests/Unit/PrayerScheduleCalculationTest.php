<?php

namespace Tests\Unit;

use Tests\TestCase;
use Carbon\Carbon;
use App\Services\PrayerTimeService;
use PHPUnit\Framework\Attributes\Test;

class PrayerScheduleCalculationTest extends TestCase
{
    #[Test]
    public function formula_penambahan_jeda_adzan_dan_durasi_jendela_benar(): void
    {
        // Simulasi Adzan Dzuhur: 12:00:00
        // Setting: delay 10 menit, toleransi hadir 2 menit, jendela scan 5 menit
        $adzan = Carbon::createFromTime(12, 0, 0, 'Asia/Jakarta');

        $mulaiPresensi = $adzan->copy()->addMinutes(10); // 12:10:00
        $batasHadir = $mulaiPresensi->copy()->addMinutes(2); // 12:12:00
        $tutupScan = $mulaiPresensi->copy()->addMinutes(5); // 12:15:00

        $this->assertEquals('12:10:00', $mulaiPresensi->format('H:i:s'));
        $this->assertEquals('12:12:00', $batasHadir->format('H:i:s'));
        $this->assertEquals('12:15:00', $tutupScan->format('H:i:s'));

        // Cek toleransi hadir
        $scanTepatWaktu = Carbon::createFromTime(12, 11, 30, 'Asia/Jakarta');
        $this->assertTrue($scanTepatWaktu->lessThanOrEqualTo($batasHadir));

        // Cek terlambat
        $scanTerlambat = Carbon::createFromTime(12, 13, 0, 'Asia/Jakarta');
        $this->assertTrue($scanTerlambat->greaterThan($batasHadir));
        $this->assertTrue($scanTerlambat->lessThanOrEqualTo($tutupScan));

        // Cek di luar jendela
        $scanSetelahTutup = Carbon::createFromTime(12, 16, 0, 'Asia/Jakarta');
        $this->assertTrue($scanSetelahTutup->greaterThan($tutupScan));
    }

    #[Test]
    public function normalisasi_nama_shalat_berbagai_variasi(): void
    {
        $service = app(PrayerTimeService::class);

        $this->assertEquals('subuh', $service->normalisasiNama('Shalat Subuh'));
        $this->assertEquals('dzuhur', $service->normalisasiNama('Shalat Dzuhur Berjamaah'));
        $this->assertEquals('dzuhur', $service->normalisasiNama('Duhur'));
        $this->assertEquals('dzuhur', $service->normalisasiNama('Zuhur'));
        $this->assertEquals('ashar', $service->normalisasiNama('Sholat Ashar'));
        $this->assertEquals('maghrib', $service->normalisasiNama('Maghrib Berjamaah'));
        $this->assertEquals('isya', $service->normalisasiNama('Isya'));
    }
}
