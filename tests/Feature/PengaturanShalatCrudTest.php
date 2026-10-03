<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PengaturanShalat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;

class PengaturanShalatCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Pastikan setting tersedia
        PengaturanShalat::updateOrCreate(
            ['nama_shalat' => 'subuh'],
            [
                'label' => 'Shalat Subuh',
                'delay_adzan_menit' => 10,
                'toleransi_hadir_menit' => 3,
                'durasi_jendela_menit' => 7,
                'status_aktif' => true,
            ]
        );

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
    }

    #[Test]
    public function tamu_tidak_bisa_mengakses_halaman_pengaturan_shalat(): void
    {
        $response = $this->get('/pengaturan-shalat');
        $response->assertRedirect('/login');
    }

    #[Test]
    public function user_terautentikasi_dapat_melihat_halaman_pengaturan(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/pengaturan-shalat');

        $response->assertStatus(200);
        $response->assertSee('Pengaturan Presensi Shalat');
        $response->assertSee('Shalat Subuh');
        $response->assertSee('Shalat Dzuhur');
    }

    #[Test]
    public function user_dapat_mengubah_nilai_pengaturan_dan_membersihkan_cache(): void
    {
        $user = User::factory()->create();
        $subuh = PengaturanShalat::where('nama_shalat', 'subuh')->first();
        $dzuhur = PengaturanShalat::where('nama_shalat', 'dzuhur')->first();

        // Pastikan cache terisi
        PengaturanShalat::getAllCached();
        $this->assertTrue(Cache::has(PengaturanShalat::CACHE_KEY));

        $payload = [
            'settings' => [
                [
                    'id' => $subuh->id,
                    'delay_adzan_menit' => 12,
                    'toleransi_hadir_menit' => 4,
                    'durasi_jendela_menit' => 8,
                    'status_aktif' => '1',
                ],
                [
                    'id' => $dzuhur->id,
                    'delay_adzan_menit' => 8,
                    'toleransi_hadir_menit' => 3,
                    'durasi_jendela_menit' => 6,
                    // status_aktif tidak dikirim = false
                ],
            ]
        ];

        $response = $this->actingAs($user)->post('/pengaturan-shalat', $payload);

        $response->assertRedirect(route('pengaturan.shalat.index'));
        $response->assertSessionHas('success');

        // Pastikan nilai di database terupdate
        $this->assertDatabaseHas('pengaturan_shalats', [
            'id' => $subuh->id,
            'delay_adzan_menit' => 12,
            'toleransi_hadir_menit' => 4,
            'durasi_jendela_menit' => 8,
            'status_aktif' => true,
        ]);

        $this->assertDatabaseHas('pengaturan_shalats', [
            'id' => $dzuhur->id,
            'delay_adzan_menit' => 8,
            'toleransi_hadir_menit' => 3,
            'durasi_jendela_menit' => 6,
            'status_aktif' => false,
        ]);

        // Pastikan cache sudah dibersihkan
        $this->assertFalse(Cache::has(PengaturanShalat::CACHE_KEY));
    }

    #[Test]
    public function validasi_menolak_jika_durasi_jendela_lebih_kecil_dari_toleransi_hadir(): void
    {
        $user = User::factory()->create();
        $subuh = PengaturanShalat::where('nama_shalat', 'subuh')->first();

        $payload = [
            'settings' => [
                [
                    'id' => $subuh->id,
                    'delay_adzan_menit' => 10,
                    'toleransi_hadir_menit' => 5,
                    'durasi_jendela_menit' => 3, // Jendela (3) < Toleransi (5) -> Tidak Valid!
                ],
            ]
        ];

        $response = $this->actingAs($user)->post('/pengaturan-shalat', $payload);

        $response->assertSessionHasErrors(['settings.0.durasi_jendela_menit']);
    }
}
