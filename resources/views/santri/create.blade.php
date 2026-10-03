@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <h3 class="mb-4">Tambah Santri</h3>

    <form action="/santri/store" method="POST">

        @csrf

        <div class="mb-3">
            <label>Nama Santri</label>
            <input type="text" name="nama" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kamar</label>

            <select name="kamar_id" class="form-control">

                @foreach($kamars as $kamar)

                <option value="{{ $kamar->id }}">
                    {{ $kamar->nama_kamar }}
                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label class="d-flex justify-content-between align-items-center">
                <span>UID RFID Gelang / Kartu</span>
                <span id="scanBadge" class="badge bg-light text-secondary border">
                    <span class="spinner-grow spinner-grow-sm text-primary me-1" role="status" style="width:0.6rem;height:0.6rem;"></span>
                    Menunggu tap gelang ke alat RFID...
                </span>
            </label>
            <div class="input-group">
                <input type="text" id="uid_rfid" name="uid_rfid" class="form-control font-monospace" placeholder="Tempelkan gelang ke alat RFID..." required>
                <button type="button" class="btn btn-outline-primary" onclick="cekScanManual()">
                    <i class="bi bi-arrow-repeat"></i> Cek Tap
                </button>
            </div>
            <div class="form-text text-muted">
                Cukup tempelkan gelang santri ke alat pembaca RFID, maka UID akan otomatis terisi di atas.
            </div>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="status" class="form-control">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success px-4">
                Simpan
            </button>
            <a href="/santri" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

<script>
    let lastUid = "";

    function cekScanRfid() {
        fetch('/api/rfid/last-detected')
            .then(res => res.json())
            .then(data => {
                if (data.status && data.uid_rfid && data.uid_rfid !== lastUid) {
                    lastUid = data.uid_rfid;
                    const inputEl = document.getElementById('uid_rfid');
                    inputEl.value = data.uid_rfid;
                    inputEl.classList.add('is-valid');

                    const badge = document.getElementById('scanBadge');
                    badge.className = 'badge bg-success text-white shadow-sm';
                    badge.innerHTML = '✅ Terdeteksi: ' + data.uid_rfid + ' (' + data.waktu + ')';

                    setTimeout(() => {
                        inputEl.classList.remove('is-valid');
                    }, 2000);
                }
            })
            .catch(err => console.error(err));
    }

    // Polling setiap 1.5 detik
    setInterval(cekScanRfid, 1500);

    function cekScanManual() {
        cekScanRfid();
    }
</script>

@endsection