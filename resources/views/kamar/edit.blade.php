@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <h3 class="fw-bold mb-4">
        Edit Kamar
    </h3>

    <form action="/kamar/update/{{ $kamar->id }}" method="POST">

        @csrf

        <div class="mb-3">

            <label>Nama Kamar</label>

            <input type="text"
                   name="nama_kamar"
                   class="form-control"
                   value="{{ $kamar->nama_kamar }}">

        </div>

        <div class="mb-4">

            <label>Blok</label>

            <input type="text"
                   name="blok"
                   class="form-control"
                   value="{{ $kamar->blok }}">

        </div>

        <button class="btn btn-success">
            Update
        </button>

        <a href="/kamar"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection