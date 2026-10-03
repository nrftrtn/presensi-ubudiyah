@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- FILTER DAN TAMBAH ABSENSI -->
    <div class="row g-2 align-items-center mb-4">

        <!-- Tanggal -->
        <div class="col-md-2">

            <input type="date"
                   name="tanggal"
                   form="filterAbsensi"
                   class="form-control"
                   value="{{ request('tanggal') }}">

        </div>


        <!-- Kegiatan -->
        <div class="col-md-3">

            <select name="kegiatan_id"
                    form="filterAbsensi"
                    class="form-select">

                <option value="">
                    Semua Kegiatan
                </option>

                @foreach($kegiatans as $kegiatan)

                    <option value="{{ $kegiatan->id }}"
                        {{ request('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>

                        {{ $kegiatan->nama_kegiatan }}

                    </option>

                @endforeach

            </select>

        </div>


        <!-- Status -->
        <div class="col-md-2">

            <select name="status_kehadiran"
                    form="filterAbsensi"
                    class="form-select">

                <option value="">
                    Semua Status
                </option>

                <option value="hadir"
                    {{ request('status_kehadiran') == 'hadir' ? 'selected' : '' }}>

                    Hadir

                </option>

                <option value="terlambat"
                    {{ request('status_kehadiran') == 'terlambat' ? 'selected' : '' }}>

                    Terlambat

                </option>

                <option value="alpha"
                    {{ request('status_kehadiran') == 'alpha' ? 'selected' : '' }}>

                    Alpha

                </option>

            </select>

        </div>


        <!-- Cari Nama -->
        <div class="col-md-3">

            <input type="text"
                   name="keyword"
                   form="filterAbsensi"
                   class="form-control"
                   placeholder="Cari Nama Santri..."
                   value="{{ request('keyword') }}">

        </div>


        <!-- Tombol Filter -->
        <div class="col-md-2">

            <button type="submit"
                    form="filterAbsensi"
                    class="btn btn-success w-100">

                <i class="fa fa-filter"></i>
                Filter

            </button>

        </div>

    </div>


    <!-- FORM FILTER -->
    <form method="GET"
          action="/absensi"
          id="filterAbsensi">

    </form>


    <!-- TOMBOL TAMBAH -->
    <div class="d-flex justify-content-end mb-3">

        <a href="/absensi/create"
           class="btn btn-success">

            <i class="fa fa-plus"></i>
            Tambah Absensi

        </a>

    </div>


    <!-- TABEL -->
    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle mb-0">

            <thead class="table-success">

                <tr>

                    <th>No</th>

                    <th>Nama Santri</th>

                    <th>Kegiatan</th>

                    <th>Tanggal</th>

                    <th>Jam Masuk</th>

                    <th>Jam Keluar</th>

                    <th>Status</th>

                </tr>

            </thead>


            <tbody>

                @forelse($absensis as $item)

                    <tr class="{{ $item->status_kehadiran == 'alpha' ? 'table-danger' : '' }}">

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>
                            {{ $item->santri->nama ?? '-' }}
                        </td>


                        <td>
                            {{ $item->kegiatan->nama_kegiatan ?? '-' }}
                        </td>


                        <td>
                            {{ $item->tanggal }}
                        </td>


                        <td>
                            {{ $item->jam_masuk ?? '-' }}
                        </td>

                        <td>
                            {{ $item->jam_keluar ?? '-' }}
                        </td>


                        <td>

                            @if($item->status_kehadiran == 'hadir')

                                <span class="badge bg-success">
                                    Hadir
                                </span>

                            @elseif($item->status_kehadiran == 'terlambat')

                                <span class="badge bg-warning text-dark">
                                    Terlambat
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Alpha
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center text-muted py-4">

                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>

                            Data absensi belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


@endsection


<style>

    /* Tabel */

    table td,
    table th {

        vertical-align: middle;

    }


    /* Badge */

    .badge {

        font-size: 12px;

        padding: 6px 10px;

        border-radius: 8px;

    }


    /* Hover tabel */

    table tbody tr:hover {

        background-color: #f5f5f5;

        transition: 0.2s;

    }


    /* Tombol */

    .btn {

        border-radius: 8px;

    }


    /* Input */

    .form-control,
    .form-select {

        border-radius: 8px;

    }

</style>