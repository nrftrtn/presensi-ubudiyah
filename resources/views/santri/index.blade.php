@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold">
            Data Santri
        </h4>

        <a href="/santri/create" class="btn btn-success">
            + Tambah Santri
        </a>

    </div>

    <!-- FILTER BLOK (DINAMIS DARI DATABASE) -->
   <form method="GET" action="/santri" class="mb-3">

    <select name="kamar_id" class="form-select w-25" onchange="this.form.submit()">

        <option value="">-- Semua Kamar --</option>

        @foreach($kamars as $kamar)
            <option value="{{ $kamar->id }}"
                {{ request('kamar_id') == $kamar->id ? 'selected' : '' }}>

                {{ $kamar->nama_kamar }} (Blok {{ $kamar->blok }})

            </option>
        @endforeach

    </select>

</form>

    </form>

    <!-- TABLE -->
    <table class="table table-bordered table-hover align-middle">

        <thead class="table-success">

            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kamar</th>
                <th>UID RFID</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>

        </thead>

        <tbody>

            @forelse($santris as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->nama }}</td>

                <td>
                    {{ $item->kamar->nama_kamar ?? '-' }}
                </td>

                <td>{{ $item->uid_rfid }}</td>

                <td>

                    @if($item->status == 'aktif')

                        <span class="badge bg-success">
                            Aktif
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Nonaktif
                        </span>

                    @endif

                </td>

                <td>

                    <a href="/santri/edit/{{ $item->id }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="/santri/delete/{{ $item->id }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center">
                    Data santri belum tersedia
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection