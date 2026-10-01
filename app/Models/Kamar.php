<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'nama_kamar',
        'blok',
    ];

    // RELASI: satu kamar punya banyak santri
    public function santris()
    {
        return $this->hasMany(Santri::class);
    }
}