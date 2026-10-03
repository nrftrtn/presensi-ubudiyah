<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaturanShalat;
use App\Services\PrayerTimeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PengaturanShalatController extends Controller
{
    protected PrayerTimeService $prayerTimeService;

    public function __construct(PrayerTimeService $prayerTimeService)
    {
        $this->prayerTimeService = $prayerTimeService;
    }

    /**
     * Menampilkan halaman formulir pengaturan waktu presensi shalat.
     */
    public function index()
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        $pengaturans = PengaturanShalat::orderBy('id')->get();

        // Ambil waktu adzan hari ini dari API
        $waktuAdzan = [];
        try {
            $waktuAdzan = $this->prayerTimeService->getPrayerTimes($sekarang);
        } catch (\Throwable $e) {
            // Fallback jika API sedang tidak dapat dijangkau
            $waktuAdzan = [
                'subuh' => '04:30:00',
                'dzuhur' => '11:45:00',
                'ashar' => '14:55:00',
                'maghrib' => '17:45:00',
                'isya' => '18:55:00',
            ];
        }

        // Hitung simulasi jadwal untuk setiap shalat
        $simulasiJadwal = [];
        foreach ($pengaturans as $item) {
            $jamAdzan = $waktuAdzan[$item->nama_shalat] ?? '12:00:00';
            $adzan = Carbon::createFromFormat('H:i:s', $jamAdzan, 'Asia/Jakarta');

            $mulai = $adzan->copy()->addMinutes($item->delay_adzan_menit);
            $batasHadir = $mulai->copy()->addMinutes($item->toleransi_hadir_menit);
            $tutup = $mulai->copy()->addMinutes($item->durasi_jendela_menit);

            $simulasiJadwal[$item->nama_shalat] = [
                'jam_adzan' => $jamAdzan,
                'mulai' => $mulai->format('H:i'),
                'batas_hadir' => $batasHadir->format('H:i'),
                'tutup' => $tutup->format('H:i'),
            ];
        }

        return view('pengaturan.shalat', compact('pengaturans', 'waktuAdzan', 'simulasiJadwal', 'sekarang'));
    }

    /**
     * Memperbarui pengaturan waktu presensi shalat.
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.id' => 'required|exists:pengaturan_shalats,id',
            'settings.*.delay_adzan_menit' => 'required|integer|min:0|max:120',
            'settings.*.toleransi_hadir_menit' => 'required|integer|min:1|max:60',
            'settings.*.durasi_jendela_menit' => 'required|integer|min:1|max:180',
        ]);

        // Validasi relasi: durasi jendela scan tidak boleh lebih kecil dari toleransi hadir
        foreach ($request->settings as $index => $row) {
            if ((int)$row['durasi_jendela_menit'] < (int)$row['toleransi_hadir_menit']) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        "settings.{$index}.durasi_jendela_menit" =>
                            "Durasi jendela scan ({$row['durasi_jendela_menit']} mnt) tidak boleh lebih kecil dari batas toleransi hadir ({$row['toleransi_hadir_menit']} mnt)."
                    ]);
            }
        }

        // Simpan setiap pengaturan
        foreach ($request->settings as $row) {
            $pengaturan = PengaturanShalat::findOrFail($row['id']);
            $pengaturan->update([
                'delay_adzan_menit' => (int) $row['delay_adzan_menit'],
                'toleransi_hadir_menit' => (int) $row['toleransi_hadir_menit'],
                'durasi_jendela_menit' => (int) $row['durasi_jendela_menit'],
                'status_aktif' => isset($row['status_aktif']),
            ]);
        }

        // Bersihkan cache
        Cache::forget(PengaturanShalat::CACHE_KEY);

        return redirect()->route('pengaturan.shalat.index')
            ->with('success', 'Pengaturan waktu presensi shalat berhasil diperbarui!');
    }
}
