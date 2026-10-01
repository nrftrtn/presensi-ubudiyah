<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'santri_id',
        'kegiatan_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status_kehadiran',
    ];

    // =========================
    // RELASI KE SANTRI
    // =========================

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    // =========================
    // RELASI KE KEGIATAN
    // =========================

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
