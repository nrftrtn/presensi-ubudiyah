<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * MENAMPILKAN LAPORAN
     */
    public function index(Request $request)
    {
        $query = Absensi::with([
            'santri',
            'kegiatan'
        ]);

        // ==============================
        // FILTER TANGGAL AWAL
        // ==============================
        if ($request->filled('tanggal_awal')) {

            $query->whereDate(
                'tanggal',
                '>=',
                $request->tanggal_awal
            );
        }

        // ==============================
        // FILTER TANGGAL AKHIR
        // ==============================
        if ($request->filled('tanggal_akhir')) {

            $query->whereDate(
                'tanggal',
                '<=',
                $request->tanggal_akhir
            );
        }

        // ==============================
        // FILTER KEGIATAN
        // ==============================
        if ($request->filled('kegiatan_id')) {

            $query->where(
                'kegiatan_id',
                $request->kegiatan_id
            );
        }

        // ==============================
        // FILTER STATUS
        // ==============================
        if ($request->filled('status_kehadiran')) {

            $query->where(
                'status_kehadiran',
                $request->status_kehadiran
            );
        }

        // ==============================
        // AMBIL DATA
        // ==============================
        $laporans = $query
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'asc')
            ->get();

        // ==============================
        // HITUNG STATISTIK
        // ==============================
        $totalPresensi = $laporans->count();

        $hadir = $laporans
            ->where('status_kehadiran', 'hadir')
            ->count();

        $terlambat = $laporans
            ->where('status_kehadiran', 'terlambat')
            ->count();

        $alpha = $laporans
            ->where('status_kehadiran', 'alpha')
            ->count();

        // ==============================
        // DATA KEGIATAN
        // ==============================
        $kegiatans = Kegiatan::orderBy(
            'nama_kegiatan',
            'asc'
        )->get();

        // ==============================
        // KIRIM KE VIEW
        // ==============================
        return view(
            'laporan.index',
            compact(
                'laporans',
                'kegiatans',
                'totalPresensi',
                'hadir',
                'terlambat',
                'alpha'
            )
        );
    }


    /**
     * CETAK LAPORAN PDF
     */
    public function pdf(Request $request)
    {
        $query = Absensi::with([
            'santri',
            'kegiatan'
        ]);

        // ==============================
        // FILTER TANGGAL AWAL
        // ==============================
        if ($request->filled('tanggal_awal')) {

            $query->whereDate(
                'tanggal',
                '>=',
                $request->tanggal_awal
            );
        }

        // ==============================
        // FILTER TANGGAL AKHIR
        // ==============================
        if ($request->filled('tanggal_akhir')) {

            $query->whereDate(
                'tanggal',
                '<=',
                $request->tanggal_akhir
            );
        }

        // ==============================
        // FILTER KEGIATAN
        // ==============================
        if ($request->filled('kegiatan_id')) {

            $query->where(
                'kegiatan_id',
                $request->kegiatan_id
            );
        }

        // ==============================
        // FILTER STATUS
        // ==============================
        if ($request->filled('status_kehadiran')) {

            $query->where(
                'status_kehadiran',
                $request->status_kehadiran
            );
        }

        // ==============================
        // AMBIL DATA
        // ==============================
        $laporans = $query
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'asc')
            ->get();

        // ==============================
        // STATISTIK
        // ==============================
        $totalPresensi = $laporans->count();

        $hadir = $laporans
            ->where('status_kehadiran', 'hadir')
            ->count();

        $terlambat = $laporans
            ->where('status_kehadiran', 'terlambat')
            ->count();

        $alpha = $laporans
            ->where('status_kehadiran', 'alpha')
            ->count();

        // ==============================
        // PERSENTASE KEHADIRAN
        // ==============================
        $persentase = $totalPresensi > 0
            ? round(
                (($hadir + $terlambat) / $totalPresensi) * 100,
                2
            )
            : 0;

        // ==============================
        // TANGGAL CETAK
        // ==============================
        Carbon::setLocale('id');

        $tanggalCetak = Carbon::now()
            ->translatedFormat('d F Y H:i');

        // ==============================
        // FILTER UNTUK JUDUL PDF
        // ==============================
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $kegiatan = null;

        if ($request->filled('kegiatan_id')) {

            $kegiatan = Kegiatan::find(
                $request->kegiatan_id
            );
        }

        $status = $request->status_kehadiran;

        // ==============================
        // GENERATE PDF
        // ==============================
        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact(
                'laporans',
                'totalPresensi',
                'hadir',
                'terlambat',
                'alpha',
                'persentase',
                'tanggalCetak',
                'tanggalAwal',
                'tanggalAkhir',
                'kegiatan',
                'status'
            )
        );

        $pdf->setPaper(
            'A4',
            'landscape'
        );

        return $pdf->download(
            'laporan-presensi.pdf'
        );
    }
}