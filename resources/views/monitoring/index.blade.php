<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Monitoring Presensi</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        body{
            background: linear-gradient(to bottom, #14532d, #166534);
            color: white;
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
        }

        .title{
            text-align: center;
            margin-bottom: 30px;
        }

        .title h1{
            font-weight: bold;
        }

        .card-monitor{
            background: white;
            color: black;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .jam{
            font-size: 60px;
            font-weight: bold;
        }

        .tanggal{
            font-size: 20px;
            margin-top: 10px;
            color: #555;
        }

        .jumlah{
            font-size: 45px;
            font-weight: bold;
        }

        .icon-monitor{
            font-size: 50px;
            margin-bottom: 10px;
        }

        table{
            background: white;
        }

        thead{
            background: #198754;
            color: white;
        }

        tbody tr:hover{
            background: #f2f2f2;
        }

        .running-text{
            margin-top: 20px;
            background: rgba(255,255,255,0.15);
            padding: 10px;
            border-radius: 12px;
            font-size: 18px;
        }

    </style>

</head>

<body>

    <!-- ================= TITLE ================= -->

    <div class="title">

        <h1>
            MONITORING PRESENSI UBUDIYAH
        </h1>

        <h4>
            Pondok Pesantren Annuqayah
        </h4>

    </div>

    <!-- ================= JAM ================= -->

    <div class="card-monitor text-center">

        <h3>
            Jam Sekarang
        </h3>

        <div class="jam" id="jam"></div>

        <div class="tanggal" id="tanggal"></div>

    </div>

    <!-- ================= STATISTIK ================= -->

    <div class="row">

        <!-- HADIR -->

        <div class="col-md-4">

            <div class="card-monitor text-center">

                <div class="icon-monitor text-success">
                    <i class="fa fa-circle-check"></i>
                </div>

                <h4>Hadir</h4>

                <div class="jumlah">
                    {{ $hadir }}
                </div>

            </div>

        </div>

        <!-- TERLAMBAT -->

        <div class="col-md-4">

            <div class="card-monitor text-center">

                <div class="icon-monitor text-warning">
                    <i class="fa fa-user-clock"></i>
                </div>

                <h4>terlambat</h4>

                <div class="jumlah">
                    {{ $terlambat }}
                </div>

            </div>

        </div>

        <!-- ALPHA -->

        <div class="col-md-4">

            <div class="card-monitor text-center">

                <div class="icon-monitor text-danger">
                    <i class="fa fa-circle-xmark"></i>
                </div>

                <h4>Alpha</h4>

                <div class="jumlah">
                    {{ $alpha }}
                </div>

            </div>

        </div>

    </div>

    <!-- ================= ABSENSI TERBARU ================= -->

    <div class="card-monitor">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3>
                Absensi Terbaru
            </h3>

            <span class="badge bg-success p-2">
                Realtime Monitoring
            </span>

        </div>

        <table class="table table-bordered table-hover align-middle">

            <thead>

                <tr>

                    <th>Nama Santri</th>

                    <th>Kegiatan</th>

                    <th>Status</th>

                    <th>Jam</th>

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

                        @elseif($item->status_kehadiran == 'izin')

                            <span class="badge bg-warning">
                                Terlambat
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Alpha
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $item->jam_absen }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center">

                        Belum ada data absensi

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- ================= RUNNING TEXT ================= -->

    <div class="running-text">

        <marquee>
            Selamat datang di Sistem Monitoring Presensi Ubudiyah Pondok Pesantren Annuqayah ✨
        </marquee>

    </div>

    <!-- ================= SCRIPT JAM REALTIME ================= -->

    <script>

        function updateJam(){

            const now = new Date();

            const jam =
                now.toLocaleTimeString();

            const tanggal =
                now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

            document.getElementById('jam')
            .innerHTML = jam;

            document.getElementById('tanggal')
            .innerHTML = tanggal;
        }

        setInterval(updateJam, 1000);

        updateJam();

    </script>

</body>
</html>