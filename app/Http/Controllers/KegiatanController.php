<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Services\PrayerTimeService;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    protected PrayerTimeService $prayerTimeService;

    public function __construct(PrayerTimeService $prayerTimeService)
    {
        $this->prayerTimeService = $prayerTimeService;
    }


    // ===============================
    // HALAMAN DATA KEGIATAN
    // ===============================

    public function index()
    {
        $sekarang = Carbon::now('Asia/Jakarta');

        // Ambil jadwal shalat hari ini
        $waktuShalat = $this->prayerTimeService
            ->getPrayerTimes($sekarang);

        $kegiatans = Kegiatan::all();

        /*
        |--------------------------------------------------------------------------
        | GANTI JAM SHALAT DENGAN WAKTU OTOMATIS
        |--------------------------------------------------------------------------
        */

        foreach ($kegiatans as $kegiatan) {

            if (
                $this->prayerTimeService
                    ->isPrayerActivity($kegiatan->nama_kegiatan)
            ) {

                $schedule = $this->prayerTimeService
                    ->getPrayerScheduleDetails(
                        $kegiatan->nama_kegiatan,
                        $sekarang
                    );

                if ($schedule) {
                    $kegiatan->jam_mulai = $schedule['jam_mulai_presensi'];
                    $kegiatan->jam_selesai = $schedule['jam_tutup_scan'];
                    $kegiatan->hari = null;
                }
            }
        }

        return view(
            'kegiatan.index',
            compact(
                'kegiatans',
                'waktuShalat',
                'sekarang'
            )
        );
    }


    // ===============================
    // HALAMAN TAMBAH KEGIATAN
    // ===============================

    public function create()
    {
        return view('kegiatan.create');
    }


    // ===============================
    // SIMPAN DATA KEGIATAN
    // ===============================

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_jadwal' => 'required|in:harian,mingguan',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'hari' => 'nullable',
            'status' => 'required',
        ]);

        /*
        |--------------------------------------------------------------------------
        | KEGIATAN SHALAT TIDAK MENYIMPAN JAM MANUAL
        |--------------------------------------------------------------------------
        */

        if (
            $this->prayerTimeService
                ->isPrayerActivity($request->nama_kegiatan)
        ) {

            $jamMulai = null;
            $jamSelesai = null;
            $hari = null;
            $jenisJadwal = 'harian';

        } else {

            $jamMulai = $request->jam_mulai;
            $jamSelesai = $request->jam_selesai;
            $hari = $request->hari;
            $jenisJadwal = $request->jenis_jadwal;
        }

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_jadwal' => $jenisJadwal,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'hari' => $hari,
            'status' => $request->status,
        ]);

        return redirect('/kegiatan');
    }


    // ===============================
    // HALAMAN EDIT KEGIATAN
    // ===============================

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view(
            'kegiatan.edit',
            compact('kegiatan')
        );
    }


    // ===============================
    // UPDATE DATA KEGIATAN
    // ===============================

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_jadwal' => 'required|in:harian,mingguan',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'hari' => 'nullable',
            'status' => 'required',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | KEGIATAN SHALAT
        |--------------------------------------------------------------------------
        */

        if (
            $this->prayerTimeService
                ->isPrayerActivity($request->nama_kegiatan)
        ) {

            $kegiatan->update([
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_jadwal' => 'harian',
                'jam_mulai' => null,
                'jam_selesai' => null,
                'hari' => null,
                'status' => $request->status,
            ]);

        } else {

            $kegiatan->update([
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_jadwal' => $request->jenis_jadwal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'hari' => $request->hari,
                'status' => $request->status,
            ]);
        }

        return redirect('/kegiatan');
    }


    // ===============================
    // HAPUS DATA KEGIATAN
    // ===============================

    public function delete($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->delete();

        return redirect('/kegiatan');
    }
}