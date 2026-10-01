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
            <label>UID RFID</label>
            <input type="text" name="uid_rfid" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
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

        <button class="btn btn-success">
            Simpan
        </button>

    </form>

</div>

@endsection