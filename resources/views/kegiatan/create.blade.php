@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <h4 class="fw-bold mb-4">
        Tambah Kegiatan
    </h4>

    <form action="/kegiatan/store" method="POST">
        @csrf

        {{-- Nama Kegiatan --}}
        <div class="mb-3">

            <label class="form-label">
                Nama Kegiatan
            </label>

            <input
                type="text"
                name="nama_kegiatan"
                class="form-control"
                required>

        </div>


        {{-- Jenis Jadwal --}}
        <div class="mb-3">

            <label class="form-label">
                Jenis Jadwal
            </label>

            <select
                name="jenis_jadwal"
                id="jenis_jadwal"
                class="form-control"
                required>

                <option value="harian">
                    Harian
                </option>

                <option value="mingguan">
                    Mingguan
                </option>

            </select>

        </div>


        {{-- Jam Mulai --}}
        <div class="mb-3">

            <label class="form-label">
                Jam Mulai
            </label>

            <input
                type="time"
                name="jam_mulai"
                id="jam_mulai"
                class="form-control">

            <small class="text-muted">
                Untuk kegiatan shalat, waktu akan ditentukan otomatis oleh sistem.
            </small>

        </div>


        {{-- Jam Selesai --}}
        <div class="mb-3">

            <label class="form-label">
                Jam Selesai
            </label>

            <input
                type="time"
                name="jam_selesai"
                id="jam_selesai"
                class="form-control">

        </div>


        {{-- Hari --}}
        <div class="mb-3">

            <label class="form-label">
                Hari
            </label>

            <select
                name="hari"
                id="hari"
                class="form-control">

                <option value="">
                    -- Pilih Hari --
                </option>

                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>

            </select>

            <small class="text-muted">
                Diisi untuk kegiatan mingguan, misalnya Diba'iyah.
            </small>

        </div>


        {{-- Status --}}
        <div class="mb-3">

            <label class="form-label">
                Status
            </label>

            <select
                name="status"
                class="form-control"
                required>

                <option value="aktif">
                    Aktif
                </option>

                <option value="nonaktif">
                    Nonaktif
                </option>

            </select>

        </div>


        {{-- Tombol --}}
        <button class="btn btn-success">
            <i class="fa fa-save"></i>
            Simpan
        </button>

        <a
            href="/kegiatan"
            class="btn btn-secondary">

            Kembali

        </a>

    </form>

</div>

@endsection

