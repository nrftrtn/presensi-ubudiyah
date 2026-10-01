<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPUDA - Sistem Presensi Ubudiyah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            background: linear-gradient(135deg, #14532d, #22c55e);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: white;
            border-radius: 24px;
            padding: 42px;
            box-shadow: 0 15px 40px rgba(0,0,0,.20);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 85px;
            height: 85px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .logo h2 {
            margin-top: 10px;
            margin-bottom: 4px;
            font-weight: 800;
            color: #14532d;
            letter-spacing: .5px;
        }

        .logo .subtitle {
            color: #6b7280;
            font-size: 14px;
        }

        .logo .institution {
            color: #15803d;
            font-size: 13px;
            font-weight: 600;
            margin-top: 5px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 13px;
        }

        .form-control:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 .2rem rgba(34,197,94,.15);
        }

        .btn-login {
            background: #16a34a;
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 10px;
            transition: .2s;
        }

        .btn-login:hover {
            background: #15803d;
        }

        .welcome-text {
            text-align: center;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            color: #9ca3af;
            font-size: 12px;
        }

    </style>

</head>


<body>

    <div class="login-card">


        <!-- LOGO & IDENTITAS SISTEM -->

        <div class="logo">

            <img src="{{ asset('images/ubudiyah.png') }}"
                 alt="Logo Ubudiyah">


            <h2>SIPUDA</h2>

            <div class="subtitle">
                Sistem Presensi Ubudiyah
            </div>

            <div class="institution">
                PP. Annuqayah Lubangsa Selatan Putri
            </div>

        </div>


        <!-- PESAN SELAMAT DATANG -->

        <div class="welcome-text">

            Silakan masuk untuk mengakses sistem

        </div>


        <!-- PESAN ERROR -->

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif


        <!-- FORM LOGIN -->

        <form action="/login" method="POST">

            @csrf


            <!-- EMAIL -->

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Masukkan email"
                       required>

            </div>


            <!-- PASSWORD -->

            <div class="mb-4">

                <label class="form-label">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required>

            </div>


            <!-- TOMBOL MASUK -->

            <button type="submit"
                    class="btn btn-success btn-login w-100">

                Masuk ke SIPUDA

            </button>

        </form>


        <!-- FOOTER -->

        <div class="footer-text">

            Sistem Presensi Ubudiyah Berbasis RFID

        </div>


    </div>

</body>

</html>