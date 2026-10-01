@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <h4 class="fw-bold mb-4">
        Edit Kegiatan
    </h4>

    <form action="/kegiatan/update/{{ $kegiatan->id }}" method="POST">
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
                value="{{ $kegiatan->nama_kegiatan }}"
                required>

        </div>


        {{-- Jenis Jadwal --}}
        <div class="mb-3">

            <label class="form-label">
                Jenis Jadwal
            </label>

            <select
                name="jenis_jadwal"
                class="form-control"
                required>

                <option
                    value="harian"
                    {{ $kegiatan->jenis_jadwal == 'harian' ? 'selected' : '' }}>
                    Harian
                </option>

                <option
                    value="mingguan"
                    {{ $kegiatan->jenis_jadwal == 'mingguan' ? 'selected' : '' }}>
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
                class="form-control"
                value="{{ $kegiatan->jam_mulai }}">

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
                class="form-control"
                value="{{ $kegiatan->jam_selesai }}">

        </div>


        {{-- Hari --}}
        <div class="mb-3">

            <label class="form-label">
                Hari
            </label>

            <select
                name="hari"
                class="form-control">

                <option value="">
                    -- Pilih Hari --
                </option>

                <option value="Senin"
                    {{ $kegiatan->hari == 'Senin' ? 'selected' : '' }}>
                    Senin
                </option>

                <option value="Selasa"
                    {{ $kegiatan->hari == 'Selasa' ? 'selected' : '' }}>
                    Selasa
                </option>

                <option value="Rabu"
                    {{ $kegiatan->hari == 'Rabu' ? 'selected' : '' }}>
                    Rabu
                </option>

                <option value="Kamis"
                    {{ $kegiatan->hari == 'Kamis' ? 'selected' : '' }}>
                    Kamis
                </option>

                <option value="Jumat"
                    {{ $kegiatan->hari == 'Jumat' ? 'selected' : '' }}>
                    Jumat
                </option>

                <option value="Sabtu"
                    {{ $kegiatan->hari == 'Sabtu' ? 'selected' : '' }}>
                    Sabtu
                </option>

                <option value="Minggu"
                    {{ $kegiatan->hari == 'Minggu' ? 'selected' : '' }}>
                    Minggu
                </option>

            </select>

            <small class="text-muted">
                Diisi untuk kegiatan mingguan, misalnya Diba'iyah.
            </small>

        </div>


        {{-- Status --}}
        <div class="mb-4">

            <label class="form-label">
                Status
            </label>

            <select
                name="status"
                class="form-control">

                <option
                    value="aktif"
                    {{ $kegiatan->status == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option
                    value="nonaktif"
                    {{ $kegiatan->status == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>

            </select>

        </div>


        {{-- Tombol --}}
        <button class="btn btn-success">
            <i class="fa fa-save"></i>
            Update
        </button>

        <a
            href="/kegiatan"
            class="btn btn-secondary">

            Kembali

        </a>

    </form>

</div>

@endsection

