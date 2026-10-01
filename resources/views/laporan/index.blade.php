@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    {{-- =====================================================
         HEADER LAPORAN
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="fw-bold mb-0">
            Laporan Presensi
        </h4>

        <a href="/laporan/pdf{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
           class="btn btn-danger">

            <i class="fa fa-print"></i>
            Cetak PDF

        </a>

    </div>


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="row mb-4">

        {{-- TOTAL HADIR --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 statistik-card">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        Total Hadir
                    </h6>

                    <h2 class="fw-bold text-success mb-0">

                        {{ $laporans->where('status_kehadiran', 'hadir')->count() }}

                    </h2>

                </div>

            </div>

        </div>


        {{-- TOTAL TERLAMBAT --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 statistik-card">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        Total Terlambat
                    </h6>

                    <h2 class="fw-bold text-warning mb-0">

                        {{ $laporans->where('status_kehadiran', 'terlambat')->count() }}

                    </h2>

                </div>

            </div>

        </div>


        {{-- TOTAL ALPHA --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 statistik-card">

                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">
                        Total Alpha
                    </h6>

                    <h2 class="fw-bold text-danger mb-0">

                        {{ $laporans->where('status_kehadiran', 'alpha')->count() }}

                    </h2>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         FILTER
    ====================================================== --}}

    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">

        <form method="GET"
              action="/laporan">

            <div class="row g-3">


                {{-- TANGGAL AWAL --}}
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


                {{-- TANGGAL AKHIR --}}
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


                {{-- KEGIATAN --}}
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


                {{-- STATUS --}}
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


                {{-- TOMBOL --}}
                <div class="col-12 d-flex justify-content-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >

                        <i class="fa fa-filter"></i>
                        Tampilkan

                    </button>


                    <a
                        href="/laporan"
                        class="btn btn-secondary"
                    >

                        <i class="fa fa-refresh"></i>
                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =====================================================
         INFORMASI FILTER AKTIF
    ====================================================== --}}

    @if(
        request('tanggal_awal') ||
        request('tanggal_akhir') ||
        request('kegiatan_id') ||
        request('status_kehadiran')
    )

        <div class="alert alert-success border-0 rounded-3 mb-4">

            <i class="fa fa-filter me-1"></i>

            <strong>Filter Aktif:</strong>

            @if(request('tanggal_awal'))

                Mulai:
                <strong>
                    {{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d-m-Y') }}
                </strong>

            @endif


            @if(request('tanggal_akhir'))

                &nbsp; Sampai:
                <strong>
                    {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d-m-Y') }}
                </strong>

            @endif


            @if(request('kegiatan_id'))

                @php
                    $kegiatanFilter = $kegiatans->firstWhere(
                        'id',
                        request('kegiatan_id')
                    );
                @endphp

                &nbsp; Kegiatan:
                <strong>
                    {{ $kegiatanFilter->nama_kegiatan ?? '-' }}
                </strong>

            @endif


            @if(request('status_kehadiran'))

                &nbsp; Status:
                <strong>
                    {{ ucfirst(request('status_kehadiran')) }}
                </strong>

            @endif

        </div>

    @endif


    {{-- =====================================================
         TABEL LAPORAN
    ====================================================== --}}

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle mb-0">

            <thead class="table-success">

                <tr>

                    <th width="60">
                        No
                    </th>

                    <th>
                        Nama Santri
                    </th>

                    <th>
                        Kegiatan
                    </th>

                    <th>
                        Tanggal
                    </th>

                    <th>
                        Jam Absen
                    </th>

                    <th>
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($laporans as $item)

                    <tr>

                        {{-- NO --}}
                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- SANTRI --}}
                        <td>

                            {{ $item->santri->nama ?? '-' }}

                        </td>


                        {{-- KEGIATAN --}}
                        <td>

                            {{ $item->kegiatan->nama_kegiatan ?? '-' }}

                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}

                        </td>


                        {{-- JAM --}}
                        <td>

                            {{ $item->jam_absen ?? '-' }}

                        </td>


                        {{-- STATUS --}}
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

                        <td
                            colspan="6"
                            class="text-center text-muted py-4"
                        >

                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>

                            Data laporan belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection


{{-- =====================================================
     STYLE
====================================================== --}}

<style>

.statistik-card {
    transition: 0.2s;
}

.statistik-card:hover {
    transform: translateY(-2px);
}

table td,
table th {
    vertical-align: middle;
}

.table-success th {
    font-weight: 600;
}

.badge {
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 8px;
}

.form-control,
.form-select {
    border-radius: 8px;
}

.btn {
    border-radius: 8px;
}

table tbody tr:hover {
    background-color: #f5f5f5;
    transition: 0.2s;
}

.alert {
    font-size: 14px;
}

</style>