<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPUDA - Sistem Presensi Ubudiyah</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        body{
            background:#f5f7fa;
            font-family:'Segoe UI',sans-serif;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            overflow-y:auto;
            background:linear-gradient(180deg,#14532d,#166534);
            padding:20px 15px;
            color:white;
            box-shadow:3px 0 15px rgba(0,0,0,.1);
        }

        .sidebar .logo{
            text-align:center;
            margin-bottom:30px;
        }

        .sidebar .logo img{
            width:90px;
            height:90px;
            object-fit:contain;
            margin-bottom:10px;
        }

        .sidebar .logo h4{
            font-weight:800;
            margin-bottom:2px;
            letter-spacing:.5px;
        }

        .sidebar .logo .subtitle{
            font-size:13px;
            opacity:.9;
        }

        .sidebar .logo small{
            display:block;
            margin-top:4px;
            opacity:.75;
            font-size:11px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:12px 15px;
            border-radius:12px;
            margin-bottom:6px;
            transition:.3s;
            font-size:15px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.15);
            transform:translateX(5px);
        }

        .sidebar a.active{
            background:white;
            color:#14532d;
            font-weight:bold;
        }

        .sidebar a i{
            width:25px;
        }

        /* CONTENT */

        .content{
            margin-left:260px;
            padding:20px;
        }

        /* NAVBAR */

        .navbar-custom{
            background:white;
            border-radius:18px;
            padding:15px 20px;
            box-shadow:0 2px 12px rgba(0,0,0,.05);
            margin-bottom:25px;
        }

        .navbar-custom h5{
            font-weight:700;
        }

        /* CARD */

        .card{
            border:none;
            border-radius:18px;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        /* FOOTER */

        .footer{
            margin-top:30px;
            text-align:center;
            color:#777;
            font-size:14px;
        }

    </style>

    @stack('style')

</head>


<body>


    <!-- =========================================
         SIDEBAR SIPUDA
    ========================================== -->

    <div class="sidebar">

        <div class="logo">

            <img src="{{ asset('images/ubudiyah.png') }}"
                 alt="Logo SIPUDA">

            <h4>SIPUDA</h4>

            <div class="subtitle">
                Sistem Presensi Ubudiyah
            </div>

            <small>
                PP. Annuqayah Lubangsa Selatan Putri
            </small>

        </div>


        <!-- Dashboard -->
        <a href="/"
           class="{{ request()->is('/') ? 'active' : '' }}">

            <i class="fa fa-home"></i>

            Dashboard

        </a>


        <!-- Data Santri -->
        <a href="/santri"
           class="{{ request()->is('santri*') ? 'active' : '' }}">

            <i class="fa fa-users"></i>

            Data Santri

        </a>


        <!-- Data Kamar -->
        <a href="/kamar"
           class="{{ request()->is('kamar*') ? 'active' : '' }}">

            <i class="fa fa-bed"></i>

            Data Kamar

        </a>


        <!-- Data Kegiatan -->
        <a href="/kegiatan"
           class="{{ request()->is('kegiatan*') ? 'active' : '' }}">

            <i class="fa fa-calendar"></i>

            Data Kegiatan

        </a>


        <!-- Data Absensi -->
        <a href="/absensi"
           class="{{ request()->is('absensi*') ? 'active' : '' }}">

            <i class="fa fa-check-circle"></i>

            Data Absensi

        </a>


        <!-- Monitoring Presensi -->
        <a href="/monitoring"
           class="{{ request()->is('monitoring*') ? 'active' : '' }}">

            <i class="fa fa-chart-line"></i>

            Monitoring Presensi

        </a>


        <!-- Laporan Presensi -->
        <a href="/laporan"
           class="{{ request()->is('laporan*') ? 'active' : '' }}">

            <i class="fa fa-file-alt"></i>

            Laporan Presensi

        </a>


        <!-- Rekap Mingguan -->
        <a href="/rekap"
           class="{{ request()->is('rekap*') ? 'active' : '' }}">

            <i class="fa fa-table"></i>

            Rekap Presensi Mingguan

        </a>


        <!-- Pengaturan Shalat -->
        <a href="/pengaturan-shalat"
           class="{{ request()->is('pengaturan-shalat*') ? 'active' : '' }}">

            <i class="fa fa-sliders-h"></i>

            Pengaturan Shalat

        </a>


        <hr style="border-color:rgba(255,255,255,0.2);">


        <!-- Logout -->
        <a href="/logout">

            <i class="fa fa-right-from-bracket"></i>

            Keluar

        </a>

    </div>


    <!-- =========================================
         CONTENT
    ========================================== -->

    <div class="content">


        <!-- =====================================
             HEADER DINAMIS
        ====================================== -->

        @php

            if (request()->is('/')) {

                $pageTitle = 'Dashboard Admin';

            } elseif (request()->is('santri*')) {

                $pageTitle = 'Data Santri';

            } elseif (request()->is('kamar*')) {

                $pageTitle = 'Data Kamar';

            } elseif (request()->is('kegiatan*')) {

                $pageTitle = 'Data Kegiatan';

            } elseif (request()->is('absensi*')) {

                $pageTitle = 'Data Absensi';

            } elseif (request()->is('monitoring*')) {

                $pageTitle = 'Monitoring Presensi';

            } elseif (request()->is('laporan*')) {

                $pageTitle = 'Laporan Presensi';

            } elseif (request()->is('rekap*')) {

                $pageTitle = 'Rekap Presensi Mingguan';

            } else {

                $pageTitle = 'SIPUDA';

            }

        @endphp


        <div class="navbar-custom d-flex justify-content-between align-items-center">

            <div>

                <h5 class="mb-0">

                    {{ $pageTitle }}

                </h5>

                <small class="text-muted">

                    SIPUDA - Sistem Presensi Ubudiyah

                </small>

            </div>


            <div class="text-end">

                <div class="fw-bold text-success">

                    {{ date('d F Y') }}

                </div>

                <i class="fa fa-user-circle fa-2x text-success"></i>

            </div>

        </div>


        <!-- =====================================
             ISI HALAMAN
        ====================================== -->

        @yield('content')


        @stack('script')


        <!-- =====================================
             FOOTER
        ====================================== -->

        <div class="footer">

            © {{ date('Y') }}

            SIPUDA - Sistem Presensi Ubudiyah |

            PP. Annuqayah Lubangsa Selatan Putri

        </div>

    </div>


</body>

</html>