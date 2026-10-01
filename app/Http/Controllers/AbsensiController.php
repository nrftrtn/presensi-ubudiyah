<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use App\Models\Santri;
use App\Models\Kegiatan;
use App\Services\PrayerTimeService;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    protected PrayerTimeService $prayerTimeService;

    public function __construct(PrayerTimeService $prayerTimeService)
    {
        $this->prayerTimeService = $prayerTimeService;
    }

    // =====================================================
    // INDEX ABSENSI
    // =====================================================

    public function index(Request $request)
    {
        $query = Absensi::with(['santri', 'kegiatan']);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('kegiatan_id')) {
            $query->where('kegiatan_id', $request->kegiatan_id);
        }

        if ($request->filled('status_kehadiran')) {
            $query->where(
                'status_kehadiran',
                $request->status_kehadiran
            );
        }

        if ($request->filled('keyword')) {
            $query->whereHas('santri', function ($q) use ($request) {
                $q->where(
                    'nama',
                    'like',
                    '%' . $request->keyword . '%'
                );
            });
        }

        $absensis = $query
            ->latest()
            ->get();

        $kegiatans = Kegiatan::all();

        return view(
            'absensi.index',
            compact(
                'absensis',
                'kegiatans'
            )
        );
    }


    // =====================================================
    // CREATE FORM
    // =====================================================

    public function create()
    {
        $santris = Santri::all();
        $kegiatans = Kegiatan::all();

        return view(
            'absensi.create',
            compact(
                'santris',
                'kegiatans'
            )
        );
    }


    // =====================================================
    // STORE MANUAL ABSENSI
    // =====================================================

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i:s',
            'status_kehadiran' => 'required|in:hadir,terlambat,alpha',
        ]);

        Absensi::create([
            'santri_id' => $request->santri_id,
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status_kehadiran' => $request->status_kehadiran,
        ]);

        return redirect('/absensi')
            ->with(
                'success',
                'Data berhasil ditambahkan'
            );
    }


    // =====================================================
    // RFID SCAN ONLINE
    // =====================================================

    public function scanRfid(Request $request)
    {
        $request->validate([
            'uid_rfid' => 'required|string'
        ]);

        // =================================================
        // WAKTU SEKARANG
        // =================================================

        $now = Carbon::now('Asia/Jakarta');

        $tanggal = $now->toDateString();
        $jamSekarang = $now->format('H:i:s');

        // =================================================
        // CARI SANTRI AKTIF
        // =================================================

        $santri = Santri::where(
                'uid_rfid',
                $request->uid_rfid
            )
            ->whereRaw(
                'LOWER(status) = ?',
                ['aktif']
            )
            ->first();

        if (!$santri) {
            return response()->json([
                'status' => false,
                'message' =>
                    'RFID tidak terdaftar atau santri tidak aktif'
            ]);
        }

        // =================================================
        // CARI KEGIATAN
        // =================================================

        $kegiatan = $this->cariKegiatan($now);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' =>
                    'Saat ini tidak ada kegiatan berlangsung'
            ]);
        }

        // =================================================
        // PROSES ABSENSI
        // =================================================

        return $this->prosesScan(
            $santri,
            $kegiatan,
            $tanggal,
            $jamSekarang,
            false
        );
    }


    // =====================================================
    // RFID SYNC OFFLINE
    // =====================================================

    public function syncRfid(Request $request)
    {
        $request->validate([
            'uid_rfid' => 'required|string',
            'tanggal' => 'required|date',
            'jam_absen' => 'required|date_format:H:i:s',
        ]);

        // =================================================
        // WAKTU ASLI SAAT RFID DITEMPEL
        // =================================================

        $tanggal = $request->tanggal;
        $jamAbsen = $request->jam_absen;

        $waktuScan = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $tanggal . ' ' . $jamAbsen,
            'Asia/Jakarta'
        );

        // =================================================
        // CARI SANTRI
        // =================================================

        $santri = Santri::where(
                'uid_rfid',
                $request->uid_rfid
            )
            ->whereRaw(
                'LOWER(status) = ?',
                ['aktif']
            )
            ->first();

        if (!$santri) {
            return response()->json([
                'status' => false,
                'message' =>
                    'RFID tidak terdaftar atau santri tidak aktif'
            ]);
        }

        // =================================================
        // CARI KEGIATAN BERDASARKAN WAKTU ASLI SCAN
        // =================================================

        $kegiatan = $this->cariKegiatan($waktuScan);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' =>
                    'Tidak ada kegiatan pada waktu scan offline'
            ]);
        }

        // =================================================
        // PROSES ABSENSI OFFLINE
        // =================================================

        return $this->prosesScan(
            $santri,
            $kegiatan,
            $tanggal,
            $jamAbsen,
            true
        );
    }


    // =====================================================
    // PROSES SCAN RFID
    // =====================================================

    private function prosesScan(
        Santri $santri,
        Kegiatan $kegiatan,
        string $tanggal,
        string $jamScan,
        bool $offline = false
    ) {
        return DB::transaction(
            function () use (
                $santri,
                $kegiatan,
                $tanggal,
                $jamScan,
                $offline
            ) {

                // =================================================
                // CARI ABSENSI PADA TANGGAL TERSEBUT
                // =================================================

                $absensi = Absensi::where(
                        'santri_id',
                        $santri->id
                    )
                    ->where(
                        'kegiatan_id',
                        $kegiatan->id
                    )
                    ->whereDate(
                        'tanggal',
                        $tanggal
                    )
                    ->lockForUpdate()
                    ->first();


                // =================================================
                // SCAN PERTAMA = JAM MASUK
                // =================================================

                if (!$absensi) {

                    $status = $this->hitungStatus(
                        $kegiatan->jam_mulai,
                        $jamScan
                    );

                    $absensi = Absensi::create([
                        'santri_id' =>
                            $santri->id,

                        'kegiatan_id' =>
                            $kegiatan->id,

                        'tanggal' =>
                            $tanggal,

                        'jam_masuk' =>
                            $jamScan,

                        'jam_keluar' =>
                            null,

                        'status_kehadiran' =>
                            $status,
                    ]);

                    return response()->json([
                        'status' => true,

                        'action' => 'masuk',

                        'message' => $offline
                            ? 'Absensi masuk offline berhasil disinkronkan'
                            : 'Absensi masuk berhasil',

                        'nama' =>
                            $santri->nama,

                        'kegiatan' =>
                            $kegiatan->nama_kegiatan,

                        'status_kehadiran' =>
                            $status,

                        'jam_mulai' =>
                            $kegiatan->jam_mulai,

                        'jam_masuk' =>
                            $jamScan,

                        'jam_keluar' =>
                            null,
                    ]);
                }


                // =================================================
                // SCAN KEDUA = JAM KELUAR
                // =================================================

                if (empty($absensi->jam_keluar)) {

                    $absensi->update([
                        'jam_keluar' =>
                            $jamScan,
                    ]);

                    return response()->json([
                        'status' => true,

                        'action' => 'keluar',

                        'message' => $offline
                            ? 'Absensi keluar offline berhasil disinkronkan'
                            : 'Absensi keluar berhasil',

                        'nama' =>
                            $santri->nama,

                        'kegiatan' =>
                            $kegiatan->nama_kegiatan,

                        'status_kehadiran' =>
                            $absensi->status_kehadiran,

                        'jam_masuk' =>
                            $absensi->jam_masuk,

                        'jam_keluar' =>
                            $jamScan,
                    ]);
                }


                // =================================================
                // SCAN KETIGA
                // =================================================

                return response()->json([
                    'status' => false,

                    'action' => 'selesai',

                    'message' =>
                        'Absensi masuk dan keluar sudah dilakukan',

                    'nama' =>
                        $santri->nama,

                    'kegiatan' =>
                        $kegiatan->nama_kegiatan,

                    'status_kehadiran' =>
                        $absensi->status_kehadiran,

                    'jam_masuk' =>
                        $absensi->jam_masuk,

                    'jam_keluar' =>
                        $absensi->jam_keluar,
                ]);
            }
        );
    }


    // =====================================================
    // CARI KEGIATAN
    // =====================================================

    private function cariKegiatan(Carbon $waktu)
    {
        $jam = $waktu->format('H:i:s');

        $hari = $this->getHariIndonesia($waktu);

        // =================================================
        // AMBIL SEMUA KEGIATAN AKTIF
        // =================================================

        $kegiatans = Kegiatan::whereRaw(
            'LOWER(status) = ?',
            ['aktif']
        )->get();


        foreach ($kegiatans as $kegiatan) {

            // =================================================
            // KEGIATAN SHALAT OTOMATIS
            // =================================================

            if (
                $this->prayerTimeService
                    ->isPrayerActivity(
                        $kegiatan->nama_kegiatan
                    )
            ) {

                $jamMulai =
                    $this->prayerTimeService
                        ->getPrayerTime(
                            $kegiatan->nama_kegiatan,
                            $waktu
                        );

                if (!$jamMulai) {
                    continue;
                }

                // =================================================
                // WAKTU MULAI SHALAT
                // =================================================

                $mulai = Carbon::createFromFormat(
                    'Y-m-d H:i:s',
                    $waktu->format('Y-m-d') .
                    ' ' .
                    $jamMulai,
                    'Asia/Jakarta'
                );

                // =================================================
                // BATAS SCAN
                //
                // Sampai 30 menit setelah waktu mulai
                // =================================================

                $batasScan = $mulai
                    ->copy()
                    ->addMinutes(30);

                if (
                    $waktu->greaterThanOrEqualTo($mulai) &&
                    $waktu->lessThanOrEqualTo($batasScan)
                ) {

                    // Set waktu mulai dinamis
                    $kegiatan->jam_mulai =
                        $jamMulai;

                    // Untuk kebutuhan proses
                    $kegiatan->jam_selesai =
                        $batasScan->format('H:i:s');

                    return $kegiatan;
                }

                continue;
            }


            // =================================================
            // KEGIATAN MANUAL
            // =================================================

            // Harian
            if (
                $kegiatan->jenis_jadwal === 'harian'
            ) {

                // Kalau hari dikosongkan,
                // berarti berlaku setiap hari.

                if (
                    !empty($kegiatan->hari) &&
                    $kegiatan->hari !== $hari
                ) {
                    continue;
                }

            }

            // Mingguan
            elseif (
                $kegiatan->jenis_jadwal === 'mingguan'
            ) {

                if (
                    $kegiatan->hari !== $hari
                ) {
                    continue;
                }
            }


            // =================================================
            // PASTIKAN JAM TERSEDIA
            // =================================================

            if (
                empty($kegiatan->jam_mulai) ||
                empty($kegiatan->jam_selesai)
            ) {
                continue;
            }


            // =================================================
            // BATAS KEGIATAN
            // =================================================

            $mulai = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $waktu->format('Y-m-d') .
                ' ' .
                $kegiatan->jam_mulai,
                'Asia/Jakarta'
            );

            $selesai = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $waktu->format('Y-m-d') .
                ' ' .
                $kegiatan->jam_selesai,
                'Asia/Jakarta'
            );

            // =================================================
            // SCAN DALAM RENTANG KEGIATAN
            // =================================================

            if (
                $waktu->greaterThanOrEqualTo($mulai) &&
                $waktu->lessThanOrEqualTo($selesai)
            ) {

                return $kegiatan;
            }
        }

        return null;
    }


    // =====================================================
    // HITUNG STATUS HADIR / TERLAMBAT
    // =====================================================

    private function hitungStatus(
        string $jamMulai,
        string $jamAbsen
    ): string {

        $mulai = Carbon::createFromFormat(
            'H:i:s',
            $jamMulai
        );

        $absen = Carbon::createFromFormat(
            'H:i:s',
            $jamAbsen
        );

        // =================================================
        // BATAS HADIR = 5 MENIT SETELAH JAM MULAI
        // =================================================

        $batasHadir = $mulai
            ->copy()
            ->addMinutes(5);

        // Tepat 5 menit = HADIR
        if (
            $absen->lessThanOrEqualTo(
                $batasHadir
            )
        ) {
            return 'hadir';
        }

        // Lebih dari 5 menit = TERLAMBAT
        return 'terlambat';
    }


    // =====================================================
    // KONVERSI HARI INGGRIS KE INDONESIA
    // =====================================================

    private function getHariIndonesia(
        Carbon $tanggal
    ): string {

        return [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ][$tanggal->format('l')];
    }
}