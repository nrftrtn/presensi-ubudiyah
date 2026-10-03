<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PengaturanShalat extends Model
{
    public const CACHE_KEY = 'pengaturan_shalat_all';

    protected $fillable = [
        'nama_shalat',
        'label',
        'delay_adzan_menit',
        'toleransi_hadir_menit',
        'durasi_jendela_menit',
        'status_aktif',
    ];

    protected $casts = [
        'delay_adzan_menit' => 'integer',
        'toleransi_hadir_menit' => 'integer',
        'durasi_jendela_menit' => 'integer',
        'status_aktif' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

    /**
     * Mengambil seluruh pengaturan shalat dengan cache.
     */
    public static function getAllCached()
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return self::all()->keyBy('nama_shalat');
        });
    }
}
