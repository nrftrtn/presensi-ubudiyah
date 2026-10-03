<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kamar;
use App\Models\Santri;
use App\Models\Kegiatan;
use App\Models\PengaturanShalat;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class RfidPresensiShalatTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Setup master data
        $kamar = Kamar::create([
            'nama_kamar' => 'Kamar Abu Bakar',
            'blok' => 'A',
            'kapasitas' => 10,
        ]);

        Santri::create([
            'nama' => 'Santri Tepat Waktu',
            'kamar_id' => $kamar->id,
            'uid_rfid' => 'RFID_TEPAT',
            'status' => 'aktif',
        ]);

        Santri::create([
            'nama' => 'Santri Terlambat',
            'kamar_id' => $kamar->id,
            'uid_rfid' => 'RFID_TELAT',
            'status' => 'aktif',
        ]);

        Santri::create([
            'nama' => 'Santri Kelewat',
            'kamar_id' => $kamar->id,
            'uid_rfid' => 'RFID_KELEWAT',
            'status' => 'aktif',
        ]);

        // 2. Buat Kegiatan Shalat Dzuhur
        Kegiatan::create([
            'nama_kegiatan' => 'Shalat Dzuhur',
            'jenis_jadwal' => 'harian',
            'jam_mulai' => '12:00:00',
            'jam_selesai' => '12:15:00',
            'hari' => 'Semua',
            'status' => 'aktif',
        ]);

        // 3. Konfigurasi Pengaturan Shalat:
        // Dzuhur: Jeda Adzan = 10 mnt, Toleransi Hadir = 2 mnt, Jendela Tutup = 5 mnt
        PengaturanShalat::updateOrCreate(
            ['nama_shalat' => 'dzuhur'],
            [
                'label' => 'Shalat Dzuhur',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 2,
                'durasi_jendela_menit' => 5,
                'status_aktif' => true,
            ]
        );

        // 4. Fake AlAdhan API response
        Http::fake([
            'https://api.aladhan.com/*' => Http::response([
                'code' => 200,
                'status' => 'OK',
                'data' => [
                    'timings' => [
                        'Fajr' => '04:30',
                        'Dhuhr' => '12:00',
                        'Asr' => '15:15',
                        'Maghrib' => '17:50',
                        'Isha' => '19:00',
                    ]
                ]
            ], 200),
        ]);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow(); // Reset waktu
        parent::tearDown();
    }

    #[Test]
    public function skenario_1_scan_saat_adzan_belum_dibuka_ditolak(): void
    {
        // Adzan 12:00:00, presensi baru buka 12:10:00
        // Jam sekarang: 12:02:00 (masih jeda dzikir)
        Carbon::setTestNow(Carbon::parse('2026-10-02 12:02:00', 'Asia/Jakarta'));

        $response = $this->postJson('/api/rfid/scan', [
            'uid_rfid' => 'RFID_TEPAT'
        ]);

        $response->assertJson([
            'status' => false,
            'message' => 'Saat ini tidak ada kegiatan berlangsung',
        ]);
    }

    #[Test]
    public function skenario_2_scan_saat_presensi_baru_dibuka_tercatat_hadir(): void
    {
        // Presensi dibuka 12:10:00
        // Jam sekarang: 12:10:30 (dalam toleransi 2 menit pertama)
        Carbon::setTestNow(Carbon::parse('2026-10-02 12:10:30', 'Asia/Jakarta'));

        $response = $this->postJson('/api/rfid/scan', [
            'uid_rfid' => 'RFID_TEPAT'
        ]);

        $response->assertJson([
            'status' => true,
            'action' => 'masuk',
            'status_kehadiran' => 'hadir',
            'kegiatan' => 'Shalat Dzuhur',
            'nama' => 'Santri Tepat Waktu',
        ]);
    }

    #[Test]
    public function skenario_3_scan_di_ujung_toleransi_hadir_tetap_tercatat_hadir(): void
    {
        // Toleransi hadir sampai 12:12:00
        // Jam sekarang: 12:11:58
        Carbon::setTestNow(Carbon::parse('2026-10-02 12:11:58', 'Asia/Jakarta'));

        $response = $this->postJson('/api/rfid/scan', [
            'uid_rfid' => 'RFID_TEPAT'
        ]);

        $response->assertJson([
            'status' => true,
            'action' => 'masuk',
            'status_kehadiran' => 'hadir',
        ]);
    }

    #[Test]
    public function skenario_4_scan_melewati_toleransi_hadir_tercatat_terlambat(): void
    {
        // Toleransi hadir 2 menit (12:10 - 12:12)
        // Jam sekarang: 12:13:15 (masih dalam jendela tutup 12:15)
        Carbon::setTestNow(Carbon::parse('2026-10-02 12:13:15', 'Asia/Jakarta'));

        $response = $this->postJson('/api/rfid/scan', [
            'uid_rfid' => 'RFID_TELAT'
        ]);

        $response->assertJson([
            'status' => true,
            'action' => 'masuk',
            'status_kehadiran' => 'terlambat',
            'nama' => 'Santri Terlambat',
        ]);
    }

    #[Test]
    public function skenario_5_scan_setelah_jendela_scan_ditutup_ditolak(): void
    {
        // Jendela tutup pada 12:15:00
        // Jam sekarang: 12:15:30 (shalat sudah selesai)
        Carbon::setTestNow(Carbon::parse('2026-10-02 12:15:30', 'Asia/Jakarta'));

        $response = $this->postJson('/api/rfid/scan', [
            'uid_rfid' => 'RFID_KELEWAT'
        ]);

        $response->assertJson([
            'status' => false,
            'message' => 'Saat ini tidak ada kegiatan berlangsung',
        ]);
    }

    #[Test]
    public function skenario_6_sync_offline_mengikuti_aturan_waktu_asli(): void
    {
        // Jam server bebas, tapi scan offline terjadi pada 12:11:00 (Hadir)
        Carbon::setTestNow(Carbon::parse('2026-10-02 15:00:00', 'Asia/Jakarta'));

        $responseHadir = $this->postJson('/api/rfid/sync', [
            'uid_rfid' => 'RFID_TEPAT',
            'tanggal' => '2026-10-02',
            'jam_absen' => '12:11:00',
        ]);

        $responseHadir->assertJson([
            'status' => true,
            'status_kehadiran' => 'hadir',
        ]);

        // Scan offline terjadi pada 12:13:00 (Terlambat)
        $responseTelat = $this->postJson('/api/rfid/sync', [
            'uid_rfid' => 'RFID_TELAT',
            'tanggal' => '2026-10-02',
            'jam_absen' => '12:13:00',
        ]);

        $responseTelat->assertJson([
            'status' => true,
            'status_kehadiran' => 'terlambat',
        ]);

        // Scan offline terjadi pada 12:18:00 (Di luar jendela)
        $responseDitolak = $this->postJson('/api/rfid/sync', [
            'uid_rfid' => 'RFID_KELEWAT',
            'tanggal' => '2026-10-02',
            'jam_absen' => '12:18:00',
        ]);

        $responseDitolak->assertJson([
            'status' => false,
            'message' => 'Tidak ada kegiatan pada waktu scan offline',
        ]);
    }
}
