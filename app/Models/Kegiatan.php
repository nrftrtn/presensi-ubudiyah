<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'jenis_jadwal',
        'jam_mulai',
        'jam_selesai',
        'hari',
        'status'
    ];

    // =========================
    // RELASI KE ABSENSI
    // =========================
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}

