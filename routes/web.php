<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Santri;
use App\Models\Kamar;
use App\Models\Kegiatan;
use App\Models\Absensi;

use App\Http\Controllers\SantriController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengaturanShalatController;

use App\Services\PrayerTimeService;


// =====================================================
// LOGIN
// =====================================================

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout']);


// =====================================================
// TEST WAKTU SHALAT
// =====================================================

Route::get('/test-prayer', function (PrayerTimeService $prayerService) {

    $sekarang = Carbon::now('Asia/Jakarta');

    $times = $prayerService->getPrayerTimes($sekarang);

    return response()->json([
        'status' => true,

        'tanggal' => $sekarang->format('Y-m-d'),

        'hari' => $sekarang->translatedFormat('l'),

        'zona_waktu' => 'Asia/Jakarta',

        'lokasi' => [
            'latitude' => env('PRAYER_LATITUDE'),
            'longitude' => env('PRAYER_LONGITUDE'),
        ],

        'waktu_shalat' => $times,
    ]);

});


// =====================================================
// AUTH PROTECTED ROUTES
// =====================================================

Route::middleware('auth')->group(function () {


    // =================================================
    // DASHBOARD
    // =================================================

    Route::get('/', function () {

        // =========================
        // 1. MASTER DATA
        // =========================

        $jumlahSantri = Santri::count();

        $jumlahKamar = Kamar::count();

        $jumlahKegiatan = Kegiatan::count();


        // =========================
        // 2. ABSENSI HARI INI
        // =========================

        $hadir = Absensi::whereDate(
                'tanggal',
                today()
            )
            ->where(
                'status_kehadiran',
                'hadir'
            )
            ->count();

        $terlambat = Absensi::whereDate(
                'tanggal',
                today()
            )
            ->where(
                'status_kehadiran',
                'terlambat'
            )
            ->count();


        // =========================
        // 3. SANTRI YANG SUDAH ABSEN
        // =========================

        $sudahAbsen = Absensi::whereDate(
                'tanggal',
                today()
            )
            ->pluck('santri_id');


        // =========================
        // 4. SANTRI YANG BELUM ABSEN
        // =========================

        $alpha = Santri::where(
                'status',
                'aktif'
            )
            ->whereNotIn(
                'id',
                $sudahAbsen
            )
            ->count();


        // =========================
        // 5. JUMLAH ABSENSI
        // =========================

        $jumlahAbsensi = $hadir + $terlambat;


        // =========================
        // 6. PERSENTASE KEHADIRAN
        // =========================

        $total = $hadir + $terlambat + $alpha;

        $persentase = $total > 0
            ? round(
                (($hadir + $terlambat) / $total) * 100
            )
            : 0;


        // =========================
        // 7. AKTIVITAS PRESENSI TERBARU
        // =========================

        $absensis = Absensi::with([
                'santri',
                'kegiatan'
            ])
            ->whereDate(
                'tanggal',
                today()
            )
            ->latest()
            ->take(5)
            ->get();


        // =========================
        // 8. SEMUA JADWAL KEGIATAN
        // =========================

        $kegiatans = Kegiatan::orderBy(
            'jam_mulai',
            'asc'
        )->get();


        // =========================
        // 9. MENENTUKAN HARI SEKARANG
        // =========================

        $sekarang = Carbon::now(
            'Asia/Jakarta'
        );

        $hariIndonesia = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $hariSekarang = $hariIndonesia[
            $sekarang->format('l')
        ];


        // =========================
        // 10. MENENTUKAN KEGIATAN AKTIF
        // =========================

        $kegiatanAktif = null;

        foreach ($kegiatans as $kegiatan) {

            // =========================
            // CEK STATUS
            // =========================

            if (
                strtolower(trim($kegiatan->status))
                !== 'aktif'
            ) {
                continue;
            }


            // =========================
            // KEGIATAN SHALAT OTOMATIS
            // =========================

            $prayerService = app(
                PrayerTimeService::class
            );

            if (
                $prayerService->isPrayerActivity(
                    $kegiatan->nama_kegiatan
                )
            ) {

                $schedule = $prayerService->getPrayerScheduleDetails(
                    $kegiatan->nama_kegiatan,
                    $sekarang
                );

                if (!$schedule || !$schedule['status_aktif']) {
                    continue;
                }

                $mulai = $schedule['waktu_mulai_presensi'];
                $selesai = $schedule['waktu_tutup_scan'];

                if (
                    $sekarang->between(
                        $mulai,
                        $selesai
                    )
                ) {
                    $kegiatan->jam_mulai = $schedule['jam_mulai_presensi'];
                    $kegiatan->jam_selesai = $schedule['jam_tutup_scan'];
                    $kegiatanAktif = $kegiatan;
                    break;
                }

                continue;
            }


            // =========================
            // KEGIATAN MINGGUAN
            // =========================

            if (
                $kegiatan->jenis_jadwal === 'mingguan'
            ) {

                if (
                    strtolower(
                        trim($kegiatan->hari)
                    )
                    !== strtolower($hariSekarang)
                ) {
                    continue;
                }
            }


            // =========================
            // KEGIATAN HARIAN
            // =========================

            if (
                $kegiatan->jenis_jadwal === 'harian'
                &&
                $kegiatan->hari
            ) {

                if (
                    strtolower(
                        trim($kegiatan->hari)
                    )
                    !== strtolower($hariSekarang)
                ) {
                    continue;
                }
            }


            // =========================
            // CEK JAM MANUAL
            // =========================

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


            // =========================
            // CEK KEGIATAN SEDANG BERLANGSUNG
            // =========================

            if (
                $sekarang->between(
                    $mulai,
                    $selesai
                )
            ) {

                $kegiatanAktif = $kegiatan;

                break;
            }
        }


        // =========================
        // 11. RETURN KE DASHBOARD
        // =========================

        return view(
            'dashboard.index',
            compact(
                'jumlahSantri',
                'jumlahKamar',
                'jumlahKegiatan',
                'jumlahAbsensi',
                'hadir',
                'terlambat',
                'alpha',
                'absensis',
                'kegiatans',
                'persentase',
                'kegiatanAktif'
            )
        );
    });


    // =================================================
    // SANTRI (CRUD)
    // =================================================

    Route::prefix('santri')->group(function () {

        Route::get(
            '/',
            [SantriController::class, 'index']
        );

        Route::get(
            '/create',
            [SantriController::class, 'create']
        );

        Route::post(
            '/store',
            [SantriController::class, 'store']
        );

        Route::get(
            '/edit/{id}',
            [SantriController::class, 'edit']
        );

        Route::post(
            '/update/{id}',
            [SantriController::class, 'update']
        );

        Route::get(
            '/delete/{id}',
            [SantriController::class, 'delete']
        );
    });


    // =================================================
    // KAMAR (CRUD)
    // =================================================

    Route::prefix('kamar')->group(function () {

        Route::get(
            '/',
            [KamarController::class, 'index']
        );

        Route::get(
            '/create',
            [KamarController::class, 'create']
        );

        Route::post(
            '/store',
            [KamarController::class, 'store']
        );

        Route::get(
            '/edit/{id}',
            [KamarController::class, 'edit']
        );

        Route::post(
            '/update/{id}',
            [KamarController::class, 'update']
        );

        Route::get(
            '/delete/{id}',
            [KamarController::class, 'delete']
        );
    });


    // =================================================
    // KEGIATAN (CRUD)
    // =================================================

    Route::prefix('kegiatan')->group(function () {

        Route::get(
            '/',
            [KegiatanController::class, 'index']
        );

        Route::get(
            '/create',
            [KegiatanController::class, 'create']
        );

        Route::post(
            '/store',
            [KegiatanController::class, 'store']
        );

        Route::get(
            '/edit/{id}',
            [KegiatanController::class, 'edit']
        );

        Route::post(
            '/update/{id}',
            [KegiatanController::class, 'update']
        );

        Route::get(
            '/delete/{id}',
            [KegiatanController::class, 'delete']
        );
    });


    // =================================================
    // ABSENSI
    // =================================================

    Route::prefix('absensi')->group(function () {

        Route::get(
            '/',
            [AbsensiController::class, 'index']
        );

        Route::get(
            '/create',
            [AbsensiController::class, 'create']
        );

        Route::post(
            '/store',
            [AbsensiController::class, 'store']
        );

        Route::post(
            '/scan-rfid',
            [AbsensiController::class, 'scanRfid']
        );

        Route::get(
            '/rfid',
            fn () => view('absensi.rfid')
        );
    });


    // =================================================
    // TEST RFID (DEV ONLY)
    // =================================================

    Route::get('/test-rfid', function () {

        return app(
            AbsensiController::class
        )->scanRfid(
            new Request([
                'uid_rfid' => 'RFID001'
            ])
        );

    });


    // =================================================
    // LAPORAN
    // =================================================

    Route::get(
        '/laporan',
        [LaporanController::class, 'index']
    );

    Route::get(
        '/laporan/pdf',
        [LaporanController::class, 'pdf']
    );


    // =================================================
    // REKAP
    // =================================================

    Route::get(
        '/rekap',
        [RekapController::class, 'index']
    );

    Route::get(
        '/rekap/pdf',
        [RekapController::class, 'pdf']
    );


    // =================================================
    // PENGATURAN SHALAT
    // =================================================

    Route::get(
        '/pengaturan-shalat',
        [PengaturanShalatController::class, 'index']
    )->name('pengaturan.shalat.index');

    Route::post(
        '/pengaturan-shalat',
        [PengaturanShalatController::class, 'update']
    )->name('pengaturan.shalat.update');


    // =================================================
    // MONITORING PRESENSI
    // =================================================

    Route::prefix('monitoring')->group(function () {


        // =============================================
        // MONITORING UTAMA
        // =============================================

        Route::get('/', function () {

            return view(
                'monitoring.index',
                [

                    'hadir' => Absensi::where(
                        'status_kehadiran',
                        'hadir'
                    )->count(),

                    'terlambat' => Absensi::where(
                        'status_kehadiran',
                        'terlambat'
                    )->count(),

                    'alpha' => Absensi::where(
                        'status_kehadiran',
                        'alpha'
                    )->count(),

                    'absensis' => Absensi::with([
                        'santri',
                        'kegiatan'
                    ])
                        ->latest()
                        ->take(10)
                        ->get(),

                ]
            );
        });


        // =============================================
        // DISPLAY MONITOR
        // =============================================

        Route::get(
            '/display',
            fn () => view(
                'monitoring.display'
            )
        );


        // =============================================
        // DATA MONITORING
        // =============================================

        Route::get('/data', function () {

            // =========================
            // HADIR
            // =========================

            $hadir = Absensi::with([
                    'santri',
                    'kegiatan'
                ])
                ->whereDate(
                    'tanggal',
                    today()
                )
                ->where(
                    'status_kehadiran',
                    'hadir'
                )
                ->latest()
                ->get();


            // =========================
            // TERLAMBAT
            // =========================

            $terlambat = Absensi::with([
                    'santri',
                    'kegiatan'
                ])
                ->whereDate(
                    'tanggal',
                    today()
                )
                ->where(
                    'status_kehadiran',
                    'terlambat'
                )
                ->latest()
                ->get();


            // =========================
            // SANTRI SUDAH ABSEN
            // =========================

            $sudahAbsen = Absensi::whereDate(
                'tanggal',
                today()
            )->pluck('santri_id');


            // =========================
            // SANTRI BELUM ABSEN
            // =========================

            $alpha = Santri::where(
                    'status',
                    'aktif'
                )
                ->whereNotIn(
                    'id',
                    $sudahAbsen
                )
                ->get()
                ->map(function ($santri) {

                    return [

                        'santri' => [
                            'nama' => $santri->nama
                        ],

                        'kegiatan' => [
                            'nama_kegiatan' =>
                                'Belum Absen'
                        ]

                    ];
                });


            // =========================
            // RESPONSE
            // =========================

            return response()->json([

                'hadir' => $hadir,

                'terlambat' => $terlambat,

                'alpha' => $alpha

            ]);
        });
    });
});