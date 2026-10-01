@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0 rounded-4 p-4">

    <h4 class="fw-bold mb-4">
        Scan RFID (Absensi Otomatis)
    </h4>

    <div class="alert alert-success">
        Tempelkan kartu RFID pada reader untuk melakukan absensi.
        Sistem akan otomatis menentukan Hadir / Terlambat.
    </div>

    {{-- FORM RFID MANUAL TEST (OPSIONAL) --}}
    <form method="POST" action="/absensi/scan-rfid">

        @csrf

        <div class="mb-3">
            <label>UID RFID (Testing Manual)</label>
            <input type="text" name="uid_rfid" class="form-control"
                   placeholder="Contoh: RFID001">
        </div>

        <button class="btn btn-success">
            Simulasikan Scan RFID
        </button>

        <a href="/absensi" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection