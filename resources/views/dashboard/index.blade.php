@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="card border-0 shadow-sm rounded-4 mb-4"
     style="background:linear-gradient(135deg,#14532d,#22c55e);">

    <div class="card-body text-white p-4">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2 class="fw-bold">
                    Assalamu'alaikum Admin 👋
                </h2>

                <p class="mb-2">
                    Selamat datang di Sistem Presensi Kegiatan Ubudiyah
                </p>

                <h5 id="jam"></h5>

                <div class="mt-3">

                    <a href="/monitoring/display"
                       target="_blank"
                       class="btn btn-light btn-sm fw-bold">

                        📺 Tampilkan ke Monitor Luar

                    </a>

                </div>

            </div>

            <div class="col-md-4 text-end">

                <i class="fa-solid fa-mosque fa-5x opacity-50"></i>

            </div>

        </div>

    </div>
</div>


<!-- ========================================================= -->
<!-- KEGIATAN AKTIF SEKARANG -->
<!-- ========================================================= -->

<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h5 class="fw-bold mb-1">

                    <i class="fa fa-bolt text-warning me-2"></i>

                    Kegiatan Aktif Sekarang

                </h5>

                <small class="text-muted">

                    Kegiatan yang sedang berlangsung saat ini

                </small>

            </div>


            @if($kegiatanAktif)

                <span class="badge bg-success rounded-pill px-3 py-2">

                    <i class="fa fa-circle me-1"
                       style="font-size:8px;"></i>

                    Sedang Berlangsung

                </span>

            @else

                <span class="badge bg-secondary rounded-pill px-3 py-2">

                    Tidak Ada Kegiatan

                </span>

            @endif

        </div>


        @if($kegiatanAktif)

            <!-- KEGIATAN SEDANG AKTIF -->

            <div class="rounded-4 p-4"
                 style="
                    background:linear-gradient(
                        135deg,
                        #f0fdf4,
                        #dcfce7
                    );
                    border:1px solid #bbf7d0;
                 ">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3 class="fw-bold text-success mb-2">

                            {{ $kegiatanAktif->nama_kegiatan }}

                        </h3>


                        <div class="text-muted">

                            <span class="me-4">

                                <i class="fa fa-calendar me-1"></i>

                                {{ $kegiatanAktif->hari }}

                            </span>


                            <span>

                                <i class="fa fa-clock me-1"></i>

                                {{ $kegiatanAktif->jam_mulai }}

                                -

                                {{ $kegiatanAktif->jam_selesai }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <a href="/absensi"
                           class="btn btn-success rounded-pill px-4">

                            <i class="fa fa-eye me-1"></i>

                            Lihat Presensi

                        </a>

                    </div>

                </div>

            </div>

        @else

            <!-- TIDAK ADA KEGIATAN AKTIF -->

            <div class="text-center py-4">

                <i class="fa fa-calendar-xmark fa-3x text-muted mb-3"></i>

                <h6 class="fw-bold">

                    Tidak Ada Kegiatan Aktif

                </h6>

                <p class="text-muted mb-0">

                    Saat ini tidak ada kegiatan yang sedang berlangsung.

                </p>

            </div>

        @endif

    </div>

</div>


<!-- ========================================================= -->
<!-- STATISTIK -->
<!-- ========================================================= -->

<div class="row">

    <!-- TOTAL SANTRI -->

    <div class="col-md-3 mb-4">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body d-flex justify-content-between">

                <div>

                    <small class="text-muted">
                        Total Santri
                    </small>

                    <h2 class="fw-bold">
                        {{ $jumlahSantri }}
                    </h2>

                </div>

                <i class="fa fa-users fa-3x text-success"></i>

            </div>

        </div>

    </div>


    <!-- TOTAL KAMAR -->

    <div class="col-md-3 mb-4">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body d-flex justify-content-between">

                <div>

                    <small class="text-muted">
                        Total Kamar
                    </small>

                    <h2 class="fw-bold">
                        {{ $jumlahKamar }}
                    </h2>

                </div>

                <i class="fa fa-bed fa-3x text-primary"></i>

            </div>

        </div>

    </div>


    <!-- TOTAL KEGIATAN -->

    <div class="col-md-3 mb-4">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body d-flex justify-content-between">

                <div>

                    <small class="text-muted">
                        Total Kegiatan
                    </small>

                    <h2 class="fw-bold">
                        {{ $jumlahKegiatan }}
                    </h2>

                </div>

                <i class="fa fa-calendar fa-3x text-warning"></i>

            </div>

        </div>

    </div>


    <!-- TOTAL ABSENSI -->

    <div class="col-md-3 mb-4">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body d-flex justify-content-between">

                <div>

                    <small class="text-muted">
                        Total Absensi
                    </small>

                    <h2 class="fw-bold">
                        {{ $jumlahAbsensi }}
                    </h2>

                </div>

                <i class="fa fa-check-circle fa-3x text-danger"></i>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- PROGRESS KEHADIRAN -->
<!-- ========================================================= -->

<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between">

            <h5 class="fw-bold">
                Tingkat Kehadiran
            </h5>

            <span>
                {{ $persentase }}%
            </span>

        </div>


        <div class="progress mt-3"
             style="height:20px;">

            <div class="progress-bar bg-success"
                 style="width:{{ $persentase }}%">

                {{ $persentase }}%

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- GRAFIK -->
<!-- ========================================================= -->

<div class="row">

    <!-- BAR CHART -->

    <div class="col-md-6 mb-4">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    Statistik Kehadiran
                </h5>

                <canvas id="grafikKehadiran"></canvas>

            </div>

        </div>

    </div>


    <!-- PIE CHART -->

    <div class="col-md-6 mb-4">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    Distribusi Kehadiran
                </h5>

                <canvas id="pieChart"></canvas>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- JADWAL KEGIATAN -->
<!-- ========================================================= -->

<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <h5 class="fw-bold mb-3">

            <i class="fa fa-calendar text-success me-2"></i>

            Jadwal Kegiatan

        </h5>


        @forelse($kegiatans as $kegiatan)

            @php

                $isAktif = $kegiatanAktif &&
                           $kegiatanAktif->id == $kegiatan->id;

            @endphp


            <div class="
                border-start
                border-4
                ps-3
                p-3
                mb-3
                rounded-end

                {{ $isAktif
                    ? 'border-success bg-light'
                    : 'border-secondary'
                }}
            ">


                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <strong>

                            {{ $kegiatan->nama_kegiatan }}

                        </strong>

                        <br>


                        <small class="text-muted">

                            <i class="fa fa-calendar me-1"></i>

                            {{ $kegiatan->hari }}

                            &nbsp;&nbsp;

                            <i class="fa fa-clock me-1"></i>

                            {{ $kegiatan->jam_mulai }}

                            -

                            {{ $kegiatan->jam_selesai }}

                        </small>

                    </div>


                    @if($isAktif)

                        <span class="badge bg-success rounded-pill">

                            <i class="fa fa-circle me-1"
                               style="font-size:7px;"></i>

                            Sedang Berlangsung

                        </span>

                    @endif

                </div>

            </div>

        @empty

            <p class="text-muted mb-0">

                Belum ada jadwal kegiatan.

            </p>

        @endforelse

    </div>

</div>


<!-- ========================================================= -->
<!-- AKTIVITAS PRESENSI TERBARU -->
<!-- ========================================================= -->

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body">

        <div class="d-flex justify-content-between mb-2">

            <h5 class="fw-bold">

                Aktivitas Presensi Terbaru

            </h5>


            <span class="badge bg-success">

                RFID Ready

            </span>

        </div>


        <table class="table table-hover mt-3">

            <thead class="table-success">

                <tr>

                    <th>Nama</th>

                    <th>Kegiatan</th>

                    <th>Status</th>

                    <th>Tanggal</th>

                </tr>

            </thead>


            <tbody>

                @forelse($absensis as $item)

                    <tr>

                        <td>
                            {{ $item->santri->nama }}
                        </td>


                        <td>
                            {{ $item->kegiatan->nama_kegiatan }}
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


                        <td>
                            {{ $item->tanggal }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center">

                            Belum ada data

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- ========================================================= -->
<!-- JAM -->
<!-- ========================================================= -->

<script>

function updateJam() {

    const now = new Date();

    document.getElementById('jam').innerHTML =
        now.toLocaleString('id-ID');

}

updateJam();

setInterval(updateJam, 1000);

</script>


<!-- ========================================================= -->
<!-- CHART.JS -->
<!-- ========================================================= -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

// =========================
// BAR CHART
// =========================

new Chart(
    document.getElementById('grafikKehadiran'),
    {
        type: 'bar',

        data: {

            labels: [
                'Hadir',
                'Terlambat',
                'Alpha'
            ],

            datasets: [

                {

                    data: [

                        {{ $hadir }},

                        {{ $terlambat }},

                        {{ $alpha }}

                    ],

                    backgroundColor: [

                        '#22c55e',
                        '#f59e0b',
                        '#ef4444'

                    ]

                }

            ]

        }

    }
);


// =========================
// PIE CHART
// =========================

new Chart(
    document.getElementById('pieChart'),
    {
        type: 'doughnut',

        data: {

            labels: [

                'Hadir',
                'Terlambat',
                'Alpha'

            ],

            datasets: [

                {

                    data: [

                        {{ $hadir }},

                        {{ $terlambat }},

                        {{ $alpha }}

                    ],

                    backgroundColor: [

                        '#22c55e',
                        '#f59e0b',
                        '#ef4444'

                    ]

                }

            ]

        }

    }
);

</script>

@endsection