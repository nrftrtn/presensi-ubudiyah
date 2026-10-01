@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <h3 class="fw-bold mb-4">
        Tambah Kamar
    </h3>

    <form action="/kamar/store" method="POST">

        @csrf

        <div class="mb-3">

            <label>Nama Kamar</label>

            <input type="text"
                   name="nama_kamar"
                   class="form-control"
                   placeholder="Contoh: A1">

        </div>

        <div class="mb-4">

            <label>Blok</label>

            <input type="text"
                   name="blok"
                   class="form-control"
                   placeholder="Contoh: Blok A">

        </div>

        <button class="btn btn-success">
            Simpan
        </button>

        <a href="/kamar"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection