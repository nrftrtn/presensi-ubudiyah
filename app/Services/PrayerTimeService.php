<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PrayerTimeService
{
    private float $latitude;
    private float $longitude;

    private string $timezone = 'Asia/Jakarta';

    // Metode Kementerian Agama Republik Indonesia
    private int $method = 20;

    // Shafi'i
    private int $school = 0;

    public function __construct()
    {
        $this->latitude = (float) env(
            'PRAYER_LATITUDE',
            -7.0654
        );

        $this->longitude = (float) env(
            'PRAYER_LONGITUDE',
            113.6722
        );
    }

    /**
     * Mengambil waktu shalat untuk tanggal tertentu.
     */
    public function getPrayerTimes(?Carbon $date = null): array
    {
        $date = $date
            ? $date->copy()->setTimezone($this->timezone)
            : Carbon::now($this->timezone);

        $tanggal = $date->format('d-m-Y');

        $cacheKey = 'prayer_times_' . $date->format('Y-m-d');

        return Cache::remember(
            $cacheKey,
            now()->addHours(12),
            function () use ($tanggal) {

                $response = Http::timeout(10)->get(
                    "https://api.aladhan.com/v1/timings/{$tanggal}",
                    [
                        'latitude' => $this->latitude,
                        'longitude' => $this->longitude,
                        'method' => $this->method,
                        'school' => $this->school,
                        'timezonestring' => $this->timezone,
                    ]
                );

                if (!$response->successful()) {
                    throw new RuntimeException(
                        'Gagal mengambil jadwal waktu shalat.'
                    );
                }

                $data = $response->json();

                if (!isset($data['data']['timings'])) {
                    throw new RuntimeException(
                        'Data waktu shalat tidak ditemukan.'
                    );
                }

                $timings = $data['data']['timings'];

                return [
                    'subuh' => $this->normalisasiWaktu(
                        $timings['Fajr'] ?? null
                    ),

                    'dzuhur' => $this->normalisasiWaktu(
                        $timings['Dhuhr'] ?? null
                    ),

                    'ashar' => $this->normalisasiWaktu(
                        $timings['Asr'] ?? null
                    ),

                    'maghrib' => $this->normalisasiWaktu(
                        $timings['Maghrib'] ?? null
                    ),

                    'isya' => $this->normalisasiWaktu(
                        $timings['Isha'] ?? null
                    ),
                ];
            }
        );
    }

    /**
     * Mengambil satu waktu shalat berdasarkan nama kegiatan.
     */
    public function getPrayerTime(
        string $nama,
        ?Carbon $date = null
    ): ?string {
        $times = $this->getPrayerTimes($date);

        $key = $this->normalisasiNama($nama);

        return $times[$key] ?? null;
    }

    /**
     * Mengambil model pengaturan shalat terkait.
     */
    public function getSetting(string $nama): ?\App\Models\PengaturanShalat
    {
        $key = $this->normalisasiNama($nama);

        try {
            $settings = \App\Models\PengaturanShalat::getAllCached();
            return $settings->get($key);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Mengambil detail jadwal presensi shalat lengkap dengan pengaturan jeda dan durasi jendela scan.
     */
    public function getPrayerScheduleDetails(string $nama, ?Carbon $date = null): ?array
    {
        $date = $date
            ? $date->copy()->setTimezone($this->timezone)
            : Carbon::now($this->timezone);

        $jamAdzan = $this->getPrayerTime($nama, $date);
        if (!$jamAdzan) {
            return null;
        }

        $key = $this->normalisasiNama($nama);
        $setting = $this->getSetting($key);

        $delayAdzan = $setting ? (int) $setting->delay_adzan_menit : 10;
        $toleransiHadir = $setting ? (int) $setting->toleransi_hadir_menit : ($key === 'subuh' ? 3 : 2);
        $durasiJendela = $setting ? (int) $setting->durasi_jendela_menit : ($key === 'subuh' ? 7 : 5);
        $statusAktif = $setting ? (bool) $setting->status_aktif : true;

        $waktuAdzan = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $date->format('Y-m-d') . ' ' . $jamAdzan,
            $this->timezone
        );

        $mulaiPresensi = $waktuAdzan->copy()->addMinutes($delayAdzan);
        $batasHadir = $mulaiPresensi->copy()->addMinutes($toleransiHadir);
        $tutupScan = $mulaiPresensi->copy()->addMinutes($durasiJendela);

        return [
            'nama_shalat' => $key,
            'label' => $setting?->label ?? ucfirst($key),
            'status_aktif' => $statusAktif,
            'jam_adzan' => $jamAdzan,
            'delay_adzan_menit' => $delayAdzan,
            'toleransi_hadir_menit' => $toleransiHadir,
            'durasi_jendela_menit' => $durasiJendela,
            'waktu_adzan' => $waktuAdzan,
            'waktu_mulai_presensi' => $mulaiPresensi,
            'waktu_batas_hadir' => $batasHadir,
            'waktu_tutup_scan' => $tutupScan,
            'jam_mulai_presensi' => $mulaiPresensi->format('H:i:s'),
            'jam_batas_hadir' => $batasHadir->format('H:i:s'),
            'jam_tutup_scan' => $tutupScan->format('H:i:s'),
        ];
    }

    /**
     * Mengubah nama kegiatan menjadi nama waktu shalat.
     */
    public function normalisasiNama(string $nama): string
    {
        $nama = strtolower(trim($nama));

        if (str_contains($nama, 'subuh')) {
            return 'subuh';
        }

        if (
            str_contains($nama, 'dzuhur') ||
            str_contains($nama, 'duhur') ||
            str_contains($nama, 'zuhur')
        ) {
            return 'dzuhur';
        }

        if (str_contains($nama, 'ashar')) {
            return 'ashar';
        }

        if (str_contains($nama, 'maghrib')) {
            return 'maghrib';
        }

        if (str_contains($nama, 'isya')) {
            return 'isya';
        }

        return $nama;
    }

    /**
     * Membersihkan format waktu dari API.
     *
     * Contoh:
     * 04:31 (+07)
     * menjadi:
     * 04:31:00
     */
    private function normalisasiWaktu(?string $waktu): ?string
    {
        if (!$waktu) {
            return null;
        }

        $waktu = trim($waktu);

        if (
            preg_match(
                '/^(\d{2}:\d{2})/',
                $waktu,
                $match
            )
        ) {
            return $match[1] . ':00';
        }

        return null;
    }

    /**
     * Mengecek apakah kegiatan merupakan shalat otomatis.
     */
    public function isPrayerActivity(string $nama): bool
    {
        $nama = strtolower(trim($nama));

        return
            str_contains($nama, 'subuh') ||
            str_contains($nama, 'dzuhur') ||
            str_contains($nama, 'duhur') ||
            str_contains($nama, 'zuhur') ||
            str_contains($nama, 'ashar') ||
            str_contains($nama, 'maghrib') ||
            str_contains($nama, 'isya');
    }
}