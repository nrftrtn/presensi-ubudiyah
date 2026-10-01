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