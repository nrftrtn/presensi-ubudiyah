<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Kamar;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapController extends Controller
{
    /**
     * ============================
     * HALAMAN REKAP
     * ============================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil data kamar dan kegiatan untuk dropdown filter
        |--------------------------------------------------------------------------
        */

        $kamars = Kamar::orderBy('nama_kamar')->get();

        $kegiatans = Kegiatan::orderBy('nama_kegiatan')->get();


        /*
        |--------------------------------------------------------------------------
        | Query Santri
        |--------------------------------------------------------------------------
        |
        | Kamar adalah milik SANTRI.
        | Jadi filter kamar harus dilakukan pada tabel santris,
        | bukan pada tabel absensis.
        |
        */

        $santriQuery = Santri::query();


        /*
        |--------------------------------------------------------------------------
        | FILTER KAMAR
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kamar_id')) {

            $santriQuery->where(
                'kamar_id',
                $request->kamar_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD DATA ABSENSI
        |--------------------------------------------------------------------------
        |
        | Filter tanggal, kegiatan, dan status diterapkan
        | pada relasi absensis.
        |
        */

        $santriQuery->with([
            'absensis' => function ($query) use ($request) {

                /*
                |-------------------------
                | Filter tanggal
                |-------------------------
                */

                if (
                    $request->filled('tanggal_awal') &&
                    $request->filled('tanggal_akhir')
                ) {

                    $query->whereBetween(
                        'tanggal',
                        [
                            $request->tanggal_awal,
                            $request->tanggal_akhir
                        ]
                    );
                }


                /*
                |-------------------------
                | Filter kegiatan
                |-------------------------
                */

                if ($request->filled('kegiatan_id')) {

                    $query->where(
                        'kegiatan_id',
                        $request->kegiatan_id
                    );
                }


                /*
                |-------------------------
                | Filter status
                |-------------------------
                */

                if ($request->filled('status_kehadiran')) {

                    $query->where(
                        'status_kehadiran',
                        $request->status_kehadiran
                    );
                }

            }
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil data santri
        |--------------------------------------------------------------------------
        */

        $santris = $santriQuery
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Kirim ke view
        |--------------------------------------------------------------------------
        */

        return view(
            'rekap.index',
            compact(
                'santris',
                'kamars',
                'kegiatans'
            )
        );
    }


    /**
     * ============================
     * CETAK PDF
     * ============================
     */
    public function pdf(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query Santri
        |--------------------------------------------------------------------------
        */

        $santriQuery = Santri::query();


        /*
        |--------------------------------------------------------------------------
        | FILTER KAMAR
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kamar_id')) {

            $santriQuery->where(
                'kamar_id',
                $request->kamar_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER ABSENSI
        |--------------------------------------------------------------------------
        */

        $santriQuery->with([
            'absensis' => function ($query) use ($request) {

                /*
                | Filter tanggal
                */

                if (
                    $request->filled('tanggal_awal') &&
                    $request->filled('tanggal_akhir')
                ) {

                    $query->whereBetween(
                        'tanggal',
                        [
                            $request->tanggal_awal,
                            $request->tanggal_akhir
                        ]
                    );
                }


                /*
                | Filter kegiatan
                */

                if ($request->filled('kegiatan_id')) {

                    $query->where(
                        'kegiatan_id',
                        $request->kegiatan_id
                    );
                }


                /*
                | Filter status
                */

                if ($request->filled('status_kehadiran')) {

                    $query->where(
                        'status_kehadiran',
                        $request->status_kehadiran
                    );
                }

            }
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil Santri
        |--------------------------------------------------------------------------
        */

        $santris = $santriQuery
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Nama kamar dan kegiatan untuk ditampilkan di PDF
        |--------------------------------------------------------------------------
        */

        $kamar = null;

        if ($request->filled('kamar_id')) {

            $kamar = Kamar::find(
                $request->kamar_id
            );
        }


        $kegiatan = null;

        if ($request->filled('kegiatan_id')) {

            $kegiatan = Kegiatan::find(
                $request->kegiatan_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'rekap.pdf',
            compact(
                'santris',
                'kamar',
                'kegiatan'
            )
        );


        $pdf->setPaper(
            'A4',
            'landscape'
        );


        return $pdf->download(
            'rekap-presensi-santri.pdf'
        );
    }
}