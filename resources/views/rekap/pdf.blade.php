<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <title>Rekap Presensi Santri</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .filter-info {
            margin-bottom: 15px;
            border: 1px solid #999;
            padding: 8px;
        }

        .filter-info table {
            width: 100%;
            border: none;
        }

        .filter-info td {
            border: none;
            padding: 3px;
            text-align: left;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th,
        table.data td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        table.data th {
            background-color: #d9ead3;
            font-weight: bold;
        }

        table.data td.nama {
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 11px;
        }

    </style>

</head>

<body>


    <!-- ==============================
         HEADER
    =============================== -->

    <div class="header">

        <h2>
            REKAP PRESENSI SANTRI
        </h2>

        <p>
            Sistem Presensi Kegiatan Ubudiyah
        </p>

    </div>


    <!-- ==============================
         INFORMASI FILTER
    =============================== -->

    <div class="filter-info">

        <table>

            <tr>

                <td width="20%">
                    <strong>Tanggal</strong>
                </td>

                <td>

                    @if(request('tanggal_awal') && request('tanggal_akhir'))

                        {{ request('tanggal_awal') }}
                        s/d
                        {{ request('tanggal_akhir') }}

                    @elseif(request('tanggal_awal'))

                        Mulai {{ request('tanggal_awal') }}

                    @elseif(request('tanggal_akhir'))

                        Sampai {{ request('tanggal_akhir') }}

                    @else

                        Semua Tanggal

                    @endif

                </td>

            </tr>


            <tr>

                <td>
                    <strong>Kegiatan</strong>
                </td>

                <td>

                    @if(request('kegiatan_id'))

                        @php
                            $kegiatan = \App\Models\Kegiatan::find(
                                request('kegiatan_id')
                            );
                        @endphp

                        {{ $kegiatan->nama_kegiatan ?? '-' }}

                    @else

                        Semua Kegiatan

                    @endif

                </td>

            </tr>


            <tr>

                <td>
                    <strong>Status</strong>
                </td>

                <td>

                    @if(request('status_kehadiran') == 'hadir')

                        Hadir

                    @elseif(request('status_kehadiran') == 'terlambat')

                        Terlambat

                    @elseif(request('status_kehadiran') == 'alpha')

                        Alpha

                    @else

                        Semua Status

                    @endif

                </td>

            </tr>

        </table>

    </div>


    <!-- ==============================
         TABEL
    =============================== -->

    <table class="data">

        <thead>

            <tr>

                <th width="8%">
                    No
                </th>

                <th>
                    Nama Santri
                </th>

                <th width="15%">
                    Hadir
                </th>

                <th width="15%">
                    Terlambat
                </th>

                <th width="15%">
                    Alpha
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($santris as $santri)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>


                    <td class="nama">
                        {{ $santri->nama }}
                    </td>


                    <td>

                        {{ $santri->absensis
                            ->where('status_kehadiran', 'hadir')
                            ->count()
                        }}

                    </td>


                    <td>

                        {{ $santri->absensis
                            ->where('status_kehadiran', 'terlambat')
                            ->count()
                        }}

                    </td>


                    <td>

                        {{ $santri->absensis
                            ->where('status_kehadiran', 'alpha')
                            ->count()
                        }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5">

                        Tidak ada data presensi.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <!-- ==============================
         FOOTER
    =============================== -->

    <div class="footer">

        Dicetak pada:
        {{ now()->format('d-m-Y H:i') }}

    </div>


</body>
</html>