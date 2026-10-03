<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Laporan Presensi Ubudiyah</title>

    <style>

        @page {
            margin: 30px 35px 35px 35px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        /* =========================================
           HEADER
        ========================================= */

        .header {
            width: 100%;
            border-bottom: 3px solid #1b5e3b;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            vertical-align: middle;
        }

        .logo-cell {
            width: 85px;
            text-align: center;
        }

        .logo {
            width: 65px;
            height: 65px;
        }

        .title-cell {
            text-align: center;
            padding-right: 70px;
        }

        .title-pondok {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 3px;
            color: #173f2a;
        }

        .title-cabang {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #173f2a;
        }

        .title-laporan {
            font-size: 15px;
            font-weight: bold;
            margin-top: 5px;
        }

        .subtitle {
            font-size: 10px;
            color: #555;
            margin-top: 3px;
        }


        /* =========================================
           INFORMASI FILTER
        ========================================= */

        .filter-box {
            width: 100%;
            border: 1px solid #b8c8bf;
            background: #f4f8f5;
            border-radius: 6px;
            padding: 9px;
            margin-bottom: 15px;
        }

        .filter-title {
            font-size: 11px;
            font-weight: bold;
            color: #174c34;
            margin-bottom: 6px;
        }

        .filter-table {
            width: 100%;
            border-collapse: collapse;
        }

        .filter-table td {
            border: none;
            padding: 3px 5px;
            vertical-align: top;
        }

        .filter-label {
            width: 105px;
            font-weight: bold;
        }


        /* =========================================
           STATISTIK
        ========================================= */

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .summary th {
            background: #1f4e3b;
            color: white;
            border: 1px solid #173d2e;
            padding: 7px;
            text-align: center;
            font-size: 10px;
        }

        .summary td {
            border: 1px solid #b5b5b5;
            padding: 9px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .summary-total {
            color: #333;
        }

        .summary-hadir {
            color: #16844a;
        }

        .summary-terlambat {
            color: #d88b00;
        }

        .summary-alpha {
            color: #d62839;
        }

        .summary-persentase {
            color: #1f4e3b;
        }


        /* =========================================
           JUDUL DATA
        ========================================= */

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #174c34;
            margin-bottom: 7px;
        }


        /* =========================================
           TABEL DATA
        ========================================= */

        .data {
            width: 100%;
            border-collapse: collapse;
        }

        .data th {
            background: #d7e9df;
            color: #173d2c;
            border: 1px solid #9bb5a6;
            padding: 7px 5px;
            text-align: center;
            font-weight: bold;
        }

        .data td {
            border: 1px solid #bdbdbd;
            padding: 6px 5px;
            text-align: center;
        }

        .data td.nama {
            text-align: left;
        }

        .data tr:nth-child(even) {
            background: #f8faf9;
        }


        /* =========================================
           BADGE STATUS
        ========================================= */

        .status-hadir {
            color: #087f3e;
            font-weight: bold;
        }

        .status-terlambat {
            color: #c77a00;
            font-weight: bold;
        }

        .status-alpha {
            color: #d62839;
            font-weight: bold;
        }


        /* =========================================
           KETERANGAN
        ========================================= */

        .keterangan {
            margin-top: 15px;
            padding: 9px 11px;
            border-left: 4px solid #1f8054;
            background: #f4f8f5;
        }

        .keterangan-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #174c34;
        }

        .keterangan ul {
            margin-top: 4px;
            margin-bottom: 2px;
            padding-left: 18px;
        }

        .keterangan li {
            margin-bottom: 3px;
        }


        /* =========================================
           FOOTER / TANDA TANGAN
        ========================================= */

        .footer {
            margin-top: 35px;
        }

        .ttd {
            width: 100%;
            border-collapse: collapse;
        }

        .ttd td {
            border: none;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .ttd-space {
            height: 55px;
        }


        /* =========================================
           NOMOR HALAMAN
        ========================================= */

        .page-number {
            position: fixed;
            bottom: -20px;
            right: 0;
            font-size: 9px;
            color: #777;
        }

    </style>

</head>


<body>


@php

    /*
    |--------------------------------------------------------------------------
    | LOGO
    |--------------------------------------------------------------------------
    |
    | Letakkan logo di:
    | public/images/logo.png
    |
    */

    $logo = public_path('images/logo.png');

@endphp


<!-- =====================================================
     HEADER
====================================================== -->

<div class="header">

    <table class="header-table">

        <tr>

            <!-- LOGO -->

            <td class="logo-cell">

                @if(file_exists($logo))

                    <img
                        src="{{ $logo }}"
                        class="logo"
                    >

                @endif

            </td>


            <!-- JUDUL -->

            <td class="title-cell">

                <div class="title-pondok">

                    PONDOK PESANTREN ANNUQAYAH

                </div>

                <div class="title-cabang">

                    LUBANGSA SELATAN PUTRI

                </div>

                <div class="title-laporan">

                    LAPORAN PRESENSI KEGIATAN UBUDIYAH

                </div>

                <div class="subtitle">

                    Sistem Presensi Kegiatan Ubudiyah Berbasis RFID

                </div>

            </td>

        </tr>

    </table>

</div>



<!-- =====================================================
     INFORMASI LAPORAN / FILTER
====================================================== -->

<div class="filter-box">

    <div class="filter-title">

        INFORMASI LAPORAN

    </div>


    <table class="filter-table">

        <tr>

            <td class="filter-label">
                Tanggal Cetak
            </td>

            <td>
                : {{ $tanggalCetak }}
            </td>

        </tr>


        <tr>

            <td class="filter-label">
                Periode
            </td>

            <td>

                :

                @if($tanggalAwal && $tanggalAkhir)

                    {{ \Carbon\Carbon::parse($tanggalAwal)->format('d-m-Y') }}

                    s/d

                    {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}

                @elseif($tanggalAwal)

                    Mulai
                    {{ \Carbon\Carbon::parse($tanggalAwal)->format('d-m-Y') }}

                @elseif($tanggalAkhir)

                    Sampai
                    {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}

                @else

                    Semua Tanggal

                @endif

            </td>

        </tr>


        <tr>

            <td class="filter-label">
                Kegiatan
            </td>

            <td>

                :

                {{ $kegiatan->nama_kegiatan ?? 'Semua Kegiatan' }}

            </td>

        </tr>


        <tr>

            <td class="filter-label">
                Status
            </td>

            <td>

                :

                @if($status)

                    {{ ucfirst($status) }}

                @else

                    Semua Status

                @endif

            </td>

        </tr>


        <tr>

            <td class="filter-label">
                Total Data
            </td>

            <td>

                :
                {{ $totalPresensi }} data presensi

            </td>

        </tr>

    </table>

</div>



<!-- =====================================================
     STATISTIK
====================================================== -->

<table class="summary">

    <tr>

        <th>
            Total Presensi
        </th>

        <th>
            Hadir
        </th>

        <th>
            Terlambat
        </th>

        <th>
            Alpha
        </th>

        <th>
            Kehadiran
        </th>

    </tr>


    <tr>

        <td class="summary-total">
            {{ $totalPresensi }}
        </td>

        <td class="summary-hadir">
            {{ $hadir }}
        </td>

        <td class="summary-terlambat">
            {{ $terlambat }}
        </td>

        <td class="summary-alpha">
            {{ $alpha }}
        </td>

        <td class="summary-persentase">
            {{ $persentase }}%
        </td>

    </tr>

</table>



<!-- =====================================================
     DATA PRESENSI
====================================================== -->

<div class="section-title">

    DATA PRESENSI SANTRI

</div>


<table class="data">

    <thead>

        <tr>

            <th width="35">
                No
            </th>

            <th>
                Nama Santri
            </th>

            <th>
                Kegiatan
            </th>

            <th>
                Jam Mulai
            </th>

            <th>
                Jam Scan RFID
            </th>

            <th>
                Tanggal
            </th>

            <th>
                Status
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse($laporans as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>


                <td class="nama">

                    {{ $item->santri->nama ?? '-' }}

                </td>


                <td>

                    {{ $item->kegiatan->nama_kegiatan ?? '-' }}

                </td>


                <td>

                    {{ $item->kegiatan->jam_mulai ?? '-' }}

                </td>


                <td>

                    {{ $item->jam_masuk ?? '-' }}

                </td>


                <td>

                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}

                </td>


                <td>

                    @if($item->status_kehadiran == 'hadir')

                        <span class="status-hadir">
                            Hadir
                        </span>

                    @elseif($item->status_kehadiran == 'terlambat')

                        <span class="status-terlambat">
                            Terlambat
                        </span>

                    @else

                        <span class="status-alpha">
                            Alpha
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="7"
                    style="text-align:center; padding:15px;"
                >

                    Tidak ada data presensi berdasarkan filter yang dipilih.

                </td>

            </tr>

        @endforelse

    </tbody>

</table>



<!-- =====================================================
     KETERANGAN
====================================================== -->

<div class="keterangan">

    <div class="keterangan-title">
        Keterangan:
    </div>

    <ul>

        <li>
            <b>Hadir</b> :
            Santri melakukan scan RFID sesuai waktu yang ditentukan.
        </li>

        <li>
            <b>Terlambat</b> :
            Santri melakukan scan RFID setelah waktu yang ditentukan.
        </li>

        <li>
            <b>Alpha</b> :
            Santri tidak melakukan presensi.
        </li>

    </ul>

</div>



<!-- =====================================================
     TANDA TANGAN
====================================================== -->

<div class="footer">

    <table class="ttd">

        <tr>

            <td>

                Mengetahui,

                <br>

                <b>Admin Presensi</b>

                <div class="ttd-space"></div>

                (................................)

            </td>


            <td>

                Sumenep,
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

                <br>

                <b>Ketua Pengurus</b>

                <div class="ttd-space"></div>

                (................................)

            </td>

        </tr>

    </table>

</div>


</body>

</html>