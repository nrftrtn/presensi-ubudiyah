@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">
                <i class="fa fa-calendar-check me-2"></i>
                Data Kegiatan
            </h5>

            <small class="text-muted">
                Jadwal kegiatan dan waktu shalat hari ini
            </small>
        </div>

        {{-- Tombol Tambah Kegiatan --}}
        <a href="/kegiatan/create" class="btn btn-success">
            <i class="fa fa-plus"></i>
            Tambah Kegiatan
        </a>
    </div>


    {{-- Informasi Jadwal Shalat --}}
    @if(isset($waktuShalat))
        <div class="alert alert-light border rounded-3 mb-4">
            <div class="d-flex align-items-center">
                <i class="fa fa-mosque me-2"></i>

                <div>
                    <strong>Jadwal Shalat Hari Ini</strong>
                    <div class="small text-muted">
                        Waktu shalat dihitung otomatis berdasarkan tanggal dan lokasi sistem.
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- Tabel Data Kegiatan --}}
    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle mb-0">

            <thead class="table-success">

                <tr>
                    <th width="50">No</th>
                    <th>Nama Kegiatan</th>
                    <th>Jenis Jadwal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Hari</th>
                    <th>Status</th>
                    <th width="170">Aksi</th>
                </tr>

            </thead>


            <tbody>

                @forelse($kegiatans as $item)

                    @php
                        $nama = strtolower($item->nama_kegiatan);

                        $isShalat =
                            str_contains($nama, 'subuh') ||
                            str_contains($nama, 'dzuhur') ||
                            str_contains($nama, 'duhur') ||
                            str_contains($nama, 'zuhur') ||
                            str_contains($nama, 'ashar') ||
                            str_contains($nama, 'maghrib') ||
                            str_contains($nama, 'isya');
                    @endphp


                    <tr>

                        {{-- No --}}
                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- Nama Kegiatan --}}
                        <td>

                            <div class="fw-semibold">
                                {{ $item->nama_kegiatan }}
                            </div>

                            @if($isShalat)
                                <small class="text-success">
                                    <i class="fa fa-sync-alt me-1"></i>
                                    Jadwal otomatis
                                </small>
                            @endif

                        </td>


                        {{-- Jenis Jadwal --}}
                        <td>

                            @if($isShalat)

                                <span class="badge bg-dark">
                                    Otomatis
                                </span>

                            @elseif($item->jenis_jadwal == 'harian')

                                <span class="badge bg-primary">
                                    Harian
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    Mingguan
                                </span>

                            @endif

                        </td>


                        {{-- Jam Mulai --}}
                        <td>

                            @if($item->jam_mulai)

                                <span class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- Jam Selesai --}}
                        <td>

                            @if($item->jam_selesai)

                                <span class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- Hari --}}
                        <td>

                            @if($isShalat)

                                <span class="text-muted">
                                    Setiap hari
                                </span>

                            @elseif($item->hari)

                                {{ $item->hari }}

                            @else

                                <span class="text-muted">
                                    Setiap hari
                                </span>

                            @endif

                        </td>


                        {{-- Status --}}
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


                        {{-- Aksi --}}
                        <td>

                            <a
                                href="/kegiatan/edit/{{ $item->id }}"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="fa fa-pen"></i>
                                Edit
                            </a>


                            <a
                                href="/kegiatan/delete/{{ $item->id }}"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus kegiatan?')"
                            >
                                <i class="fa fa-trash"></i>
                                Hapus
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center text-muted py-4"
                        >

                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>

                            Data kegiatan belum tersedia

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


    /* Tombol */
    .btn {
        border-radius: 8px;
    }


    /* Hover tabel */
    table tbody tr:hover {
        background-color: #f5f5f5;
        transition: 0.2s;
    }


    /* Alert */
    .alert {
        font-size: 14px;
    }

</style>