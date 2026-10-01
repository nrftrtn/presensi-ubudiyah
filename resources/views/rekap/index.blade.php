@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">


    <!-- =========================================================
         TOMBOL CETAK PDF
    ========================================================== -->

    <div class="d-flex justify-content-end mb-4">

        <a
            href="/rekap/pdf{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
            class="btn btn-danger"
        >

            <i class="fa fa-print"></i>

            Cetak PDF

        </a>

    </div>


    <!-- =========================================================
         FILTER
    ========================================================== -->

    <div class="card border-0 shadow-sm p-3 mb-4">

        <form
            method="GET"
            action="/rekap"
        >

            <div class="row g-3">


                <!-- =================================================
                     TANGGAL AWAL
                ================================================== -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Tanggal Awal

                    </label>

                    <input
                        type="date"
                        name="tanggal_awal"
                        class="form-control"
                        value="{{ request('tanggal_awal') }}"
                    >

                </div>


                <!-- =================================================
                     TANGGAL AKHIR
                ================================================== -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Tanggal Akhir

                    </label>

                    <input
                        type="date"
                        name="tanggal_akhir"
                        class="form-control"
                        value="{{ request('tanggal_akhir') }}"
                    >

                </div>


                <!-- =================================================
                     KAMAR
                ================================================== -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Kamar

                    </label>

                    <select
                        name="kamar_id"
                        class="form-select"
                    >

                        <option value="">

                            Semua Kamar

                        </option>


                        @foreach($kamars as $kamar)

                            <option
                                value="{{ $kamar->id }}"
                                {{ request('kamar_id') == $kamar->id ? 'selected' : '' }}
                            >

                                {{ $kamar->nama_kamar }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- =================================================
                     KEGIATAN
                ================================================== -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Kegiatan

                    </label>

                    <select
                        name="kegiatan_id"
                        class="form-select"
                    >

                        <option value="">

                            Semua Kegiatan

                        </option>


                        @foreach($kegiatans as $kegiatan)

                            <option
                                value="{{ $kegiatan->id }}"
                                {{ request('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}
                            >

                                {{ $kegiatan->nama_kegiatan }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- =================================================
                     STATUS
                ================================================== -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Status

                    </label>

                    <select
                        name="status_kehadiran"
                        class="form-select"
                    >

                        <option value="">

                            Semua Status

                        </option>


                        <option
                            value="hadir"
                            {{ request('status_kehadiran') == 'hadir' ? 'selected' : '' }}
                        >

                            Hadir

                        </option>


                        <option
                            value="terlambat"
                            {{ request('status_kehadiran') == 'terlambat' ? 'selected' : '' }}
                        >

                            Terlambat

                        </option>


                        <option
                            value="alpha"
                            {{ request('status_kehadiran') == 'alpha' ? 'selected' : '' }}
                        >

                            Alpha

                        </option>

                    </select>

                </div>


                <!-- =================================================
                     TOMBOL FILTER
                ================================================== -->

                <div class="col-md-9 d-flex align-items-end">

                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-success"
                        >

                            <i class="fa fa-filter"></i>

                            Tampilkan

                        </button>


                        <a
                            href="/rekap"
                            class="btn btn-secondary"
                        >

                            <i class="fa fa-refresh"></i>

                            Reset

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>


    <!-- =========================================================
         INFORMASI FILTER AKTIF
    ========================================================== -->

    @if(
        request('tanggal_awal') ||
        request('tanggal_akhir') ||
        request('kamar_id') ||
        request('kegiatan_id') ||
        request('status_kehadiran')
    )

        <div class="alert alert-success border-0 shadow-sm">

            <strong>
                <i class="fa fa-filter"></i>
                Filter Aktif:
            </strong>


            @if(request('tanggal_awal'))

                <span class="ms-2">

                    Mulai:
                    <strong>
                        {{ request('tanggal_awal') }}
                    </strong>

                </span>

            @endif


            @if(request('tanggal_akhir'))

                <span class="ms-2">

                    Sampai:
                    <strong>
                        {{ request('tanggal_akhir') }}
                    </strong>

                </span>

            @endif


            @if(request('kamar_id'))

                @php

                    $filterKamar = $kamars->firstWhere(
                        'id',
                        request('kamar_id')
                    );

                @endphp

                <span class="ms-2">

                    Kamar:
                    <strong>
                        {{ $filterKamar->nama_kamar ?? '-' }}
                    </strong>

                </span>

            @endif


            @if(request('kegiatan_id'))

                @php

                    $filterKegiatan = $kegiatans->firstWhere(
                        'id',
                        request('kegiatan_id')
                    );

                @endphp

                <span class="ms-2">

                    Kegiatan:
                    <strong>
                        {{ $filterKegiatan->nama_kegiatan ?? '-' }}
                    </strong>

                </span>

            @endif


            @if(request('status_kehadiran'))

                <span class="ms-2">

                    Status:
                    <strong>

                        {{ ucfirst(
                            request('status_kehadiran')
                        ) }}

                    </strong>

                </span>

            @endif

        </div>

    @endif


    <!-- =========================================================
         TABEL REKAP
    ========================================================== -->

    <div class="table-responsive">

        <table
            class="table table-bordered table-hover align-middle mb-0"
        >

            <thead class="table-success">

                <tr>

                    <th width="70">
                        No
                    </th>

                    <th>
                        Nama Santri
                    </th>

                    <th width="130">
                        Hadir
                    </th>

                    <th width="130">
                        Terlambat
                    </th>

                    <th width="130">
                        Alpha
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($santris as $santri)

                    <tr>


                        <!-- NO -->

                        <td>

                            {{ $loop->iteration }}

                        </td>


                        <!-- NAMA -->

                        <td>

                            {{ $santri->nama }}

                        </td>


                        <!-- HADIR -->

                        <td>

                            <span class="badge bg-success">

                                {{
                                    $santri->absensis
                                        ->where(
                                            'status_kehadiran',
                                            'hadir'
                                        )
                                        ->count()
                                }}

                            </span>

                        </td>


                        <!-- TERLAMBAT -->

                        <td>

                            <span
                                class="badge bg-warning text-dark"
                            >

                                {{
                                    $santri->absensis
                                        ->where(
                                            'status_kehadiran',
                                            'terlambat'
                                        )
                                        ->count()
                                }}

                            </span>

                        </td>


                        <!-- ALPHA -->

                        <td>

                            <span class="badge bg-danger">

                                {{
                                    $santri->absensis
                                        ->where(
                                            'status_kehadiran',
                                            'alpha'
                                        )
                                        ->count()
                                }}

                            </span>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center text-muted py-4"
                        >

                            <i
                                class="fa fa-inbox fa-2x mb-2 d-block"
                            ></i>

                            Belum ada data rekap

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection


<!-- =========================================================
     STYLE
========================================================== -->

<style>

    table td,
    table th {

        vertical-align: middle;

    }


    .badge {

        font-size: 12px;

        padding: 6px 10px;

        border-radius: 8px;

        min-width: 35px;

        display: inline-block;

    }


    .btn {

        border-radius: 8px;

    }


    .form-control,
    .form-select {

        border-radius: 8px;

    }


    table tbody tr:hover {

        background-color: #f5f5f5;

        transition: 0.2s;

    }


    .alert {

        border-radius: 10px;

    }

</style>