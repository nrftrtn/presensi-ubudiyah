<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $fillable = [
        'nama',
        'kamar_id',
        'uid_rfid',
        'alamat',
        'no_hp',
        'status'
    ];

    // =========================
    // RELASI KE KAMAR
    // =========================

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // =========================
    // RELASI KE ABSENSI
    // =========================

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}