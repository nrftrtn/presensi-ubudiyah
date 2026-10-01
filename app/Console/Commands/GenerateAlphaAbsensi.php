<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Santri;
use App\Models\Absensi;
use App\Models\Kegiatan;
use Carbon\Carbon;

class GenerateAlphaAbsensi extends Command
{
    protected $signature = 'absensi:generate-alpha';

    protected $description = 'Generate absensi alpha otomatis untuk santri yang tidak hadir';

    public function handle()
    {
        // =====================================================
        // WAKTU SEKARANG
        // =====================================================

        $now = Carbon::now('Asia/Jakarta');

        $tanggal = $now->toDateString();
        $jamSekarang = $now->format('H:i:s');

        // =====================================================
        // CARI HARI SEKARANG
        // =====================================================

        $hari = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ][$now->format('l')];

        // =====================================================
        // CARI SEMUA KEGIATAN HARI INI
        // YANG SUDAH SELESAI
        // =====================================================

        $kegiatans = Kegiatan::where(
                'hari',
                $hari
            )
            ->whereRaw(
                'LOWER(status) = ?',
                ['aktif']
            )
            ->where(
                'jam_selesai',
                '<',
                $jamSekarang
            )
            ->get();

        if ($kegiatans->isEmpty()) {
            $this->info('Belum ada kegiatan yang selesai.');

            return Command::SUCCESS;
        }

        // =====================================================
        // CARI SANTRI AKTIF
        // =====================================================

        $santris = Santri::whereRaw(
            'LOWER(status) = ?',
            ['aktif']
        )->get();

        // =====================================================
        // PROSES SETIAP KEGIATAN
        // =====================================================

        foreach ($kegiatans as $kegiatan) {

            $this->info(
                "Memeriksa kegiatan: {$kegiatan->nama_kegiatan}"
            );

            foreach ($santris as $santri) {

                // =================================================
                // CEK APAKAH SANTRI SUDAH MEMILIKI ABSENSI
                // =================================================

                $sudahAbsen = Absensi::where(
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
                    ->exists();

                // =================================================
                // JIKA BELUM ABSEN → BUAT ALPHA
                // =================================================

                if (!$sudahAbsen) {

                    Absensi::create([
                        'santri_id' => $santri->id,
                        'kegiatan_id' => $kegiatan->id,
                        'tanggal' => $tanggal,
                        'jam_masuk' => null,
                        'jam_keluar' => null,
                        'status_kehadiran' => 'alpha',
                    ]);

                    $this->info(
                        "Alpha dibuat: {$santri->nama}"
                    );
                }
            }
        }

        $this->info('Generate alpha selesai.');

        return Command::SUCCESS;
    }
}
