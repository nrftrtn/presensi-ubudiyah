<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kamar;
use App\Models\Kegiatan;
use App\Models\Absensi;
use App\Services\PrayerTimeService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected PrayerTimeService $prayerTimeService;

    public function __construct(PrayerTimeService $prayerTimeService)
    {
        $this->prayerTimeService = $prayerTimeService;
    }

    public function index()
    {
        // =====================================================
        // 1. MASTER DATA
        // =====================================================

        $jumlahSantri = Santri::count();
        $jumlahKamar = Kamar::count();
        $jumlahKegiatan = Kegiatan::count();

        // =====================================================
        // 2. WAKTU SEKARANG
        // =====================================================

        $sekarang = Carbon::now('Asia/Jakarta');

        // =====================================================
        // 3. ABSENSI HARI INI
        // =====================================================

        $jumlahAbsensi = Absensi::whereDate(
            'tanggal',
            $sekarang->toDateString()
        )->count();

        $hadir = Absensi::whereDate(
            'tanggal',
            $sekarang->toDateString()
        )
            ->where('status_kehadiran', 'hadir')
            ->count();

        $terlambat = Absensi::whereDate(
            'tanggal',
            $sekarang->toDateString()
        )
            ->where('status_kehadiran', 'terlambat')
            ->count();

        $alpha = Absensi::whereDate(
            'tanggal',
            $sekarang->toDateString()
        )
            ->where('status_kehadiran', 'alpha')
            ->count();

        // =====================================================
        // 4. PERSENTASE KEHADIRAN
        // =====================================================

        $totalStatus = $hadir + $terlambat + $alpha;

        $persentase = $totalStatus > 0
            ? round(($hadir / $totalStatus) * 100, 2)
            : 0;

        // =====================================================
        // 5. DATA ABSENSI TERBARU
        // =====================================================

        $absensis = Absensi::with([
            'santri',
            'kegiatan'
        ])
            ->latest()
            ->take(10)
            ->get();

        // =====================================================
        // 6. AMBIL JADWAL SHALAT OTOMATIS
        // =====================================================

        $waktuShalat = $this->prayerTimeService
            ->getPrayerTimes($sekarang);

        // =====================================================
        // 7. AMBIL SEMUA KEGIATAN
        // =====================================================

        $kegiatans = Kegiatan::all();

        // =====================================================
        // 8. SESUAIKAN JADWAL SHALAT DENGAN
        //    PrayerTimeService
        // =====================================================

        foreach ($kegiatans as $kegiatan) {

            // -------------------------------------------------
            // KEGIATAN SHALAT
            // -------------------------------------------------

            if (
                $this->prayerTimeService
                    ->isPrayerActivity($kegiatan->nama_kegiatan)
            ) {

                $jamMulai = $this->prayerTimeService
                    ->getPrayerTime(
                        $kegiatan->nama_kegiatan,
                        $sekarang
                    );

                if ($jamMulai) {

                    // Waktu mulai otomatis
                    $kegiatan->jam_mulai = $jamMulai;

                    // Shalat berlangsung 10 menit
                    $mulai = Carbon::createFromFormat(
                        'H:i:s',
                        $jamMulai,
                        'Asia/Jakarta'
                    );

                    $kegiatan->jam_selesai = $mulai
                        ->copy()
                        ->addMinutes(10)
                        ->format('H:i:s');

                    // Kegiatan shalat berlaku setiap hari
                    $kegiatan->hari = null;
                }
            }
        }

        // =====================================================
        // 9. URUTKAN JADWAL BERDASARKAN JAM
        // =====================================================

        $kegiatans = $kegiatans
            ->sortBy('jam_mulai')
            ->values();

        // =====================================================
        // 10. MENENTUKAN KEGIATAN YANG SEDANG BERLANGSUNG
        // =====================================================

        $kegiatanAktif = null;

        foreach ($kegiatans as $kegiatan) {

            // Pastikan kegiatan memiliki jam
            if (
                !$kegiatan->jam_mulai ||
                !$kegiatan->jam_selesai
            ) {
                continue;
            }

            $mulai = Carbon::createFromFormat(
                'H:i:s',
                $kegiatan->jam_mulai,
                'Asia/Jakarta'
            );

            $selesai = Carbon::createFromFormat(
                'H:i:s',
                $kegiatan->jam_selesai,
                'Asia/Jakarta'
            );

            // -------------------------------------------------
            // CEK HARI UNTUK KEGIATAN MINGGUAN
            // -------------------------------------------------

            if (
                $kegiatan->jenis_jadwal === 'mingguan'
            ) {

                $hariSekarang = $sekarang
                    ->locale('id')
                    ->translatedFormat('l');

                if (
                    strtolower($kegiatan->hari ?? '') !==
                    strtolower($hariSekarang)
                ) {
                    continue;
                }
            }

            // -------------------------------------------------
            // CEK APAKAH SEKARANG BERADA DALAM WAKTU KEGIATAN
            // -------------------------------------------------

            $waktuSekarang = $sekarang->copy();

            $mulaiHariIni = $sekarang->copy()
                ->setTime(
                    $mulai->hour,
                    $mulai->minute,
                    $mulai->second
                );

            $selesaiHariIni = $sekarang->copy()
                ->setTime(
                    $selesai->hour,
                    $selesai->minute,
                    $selesai->second
                );

            if (
                $waktuSekarang->between(
                    $mulaiHariIni,
                    $selesaiHariIni
                )
            ) {
                $kegiatanAktif = $kegiatan;
                break;
            }
        }

        // =====================================================
        // 11. KIRIM DATA KE DASHBOARD
        // =====================================================

        return view(
            'dashboard',
            compact(
                'jumlahSantri',
                'jumlahKamar',
                'jumlahKegiatan',
                'jumlahAbsensi',
                'hadir',
                'terlambat',
                'alpha',
                'persentase',
                'absensis',
                'kegiatans',
                'kegiatanAktif',
                'waktuShalat',
                'sekarang'
            )
        );
    }
}