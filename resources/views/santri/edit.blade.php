@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <h3 class="fw-bold mb-4">
        Edit Santri
    </h3>

    <form action="/santri/update/{{ $santri->id }}" method="POST">

        @csrf

        <div class="mb-3">

            <label>Nama Santri</label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ $santri->nama }}">

        </div>

        <div class="mb-3">

            <label>Kamar</label>

            <select name="kamar_id"
                    class="form-control">

                @foreach($kamars as $kamar)

                    <option value="{{ $kamar->id }}"
                        {{ $santri->kamar_id == $kamar->id ? 'selected' : '' }}>

                        {{ $kamar->nama_kamar }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>UID RFID</label>

            <input type="text"
                   name="uid_rfid"
                   class="form-control"
                   value="{{ $santri->uid_rfid }}">

        </div>

        <div class="mb-3">

            <label>Alamat</label>

            <textarea name="alamat"
                      class="form-control">{{ $santri->alamat }}</textarea>

        </div>

        <div class="mb-3">

            <label>No HP</label>

            <input type="text"
                   name="no_hp"
                   class="form-control"
                   value="{{ $santri->no_hp }}">

        </div>

        <div class="mb-4">

            <label>Status</label>

            <select name="status"
                    class="form-control">

                <option value="aktif"
                    {{ $santri->status == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="nonaktif"
                    {{ $santri->status == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>

            </select>

        </div>

        <button class="btn btn-success">
            Update Data
        </button>

        <a href="/santri"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection