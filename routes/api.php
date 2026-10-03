<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;


// =====================================================
// RFID ONLINE
// =====================================================

Route::post(
    '/rfid/scan',
    [AbsensiController::class, 'scanRfid']
);


// =====================================================
// SINKRONISASI DATA OFFLINE
// =====================================================

Route::post(
    '/rfid/sync',
    [AbsensiController::class, 'syncRfid']
);


// =====================================================
// RFID TERAKHIR TERDETEKSI (UNTUK FORM TAMBAH SANTRI)
// =====================================================

Route::get(
    '/rfid/last-detected',
    function () {
        return response()->json([
            'status' => true,
            'uid_rfid' => \Illuminate\Support\Facades\Cache::get('last_scanned_rfid'),
            'waktu' => now()->format('H:i:s'),
        ]);
    }
);