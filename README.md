# 🕌 SIPUDA - Sistem Presensi Ubudiyah Santri Berbasis IoT RFID

<p align="center">
  <img src="public/images/ubudiyah.png" alt="SIPUDA Logo" width="120" style="border-radius: 20px;">
</p>

<p align="center">
  <b>Sistem Manajemen & Presensi Ubudiyah Santri Terintegrasi Perangkat IoT ESP32 RFID RC522</b><br>
  Didukung Perhitungan Jadwal Shalat Otomatis Berbasis GPS, Pengaturan Toleransi Dinamis, dan Sinkronisasi Online/Offline.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.3%20%7C%208.5-777BB4?style=flat&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MariaDB-11.x-003545?style=flat&logo=mariadb&logoColor=white" alt="MariaDB">
  <img src="https://img.shields.io/badge/ESP32-Arduino%20Core-E7352C?style=flat&logo=espressif&logoColor=white" alt="ESP32">
  <img src="https://img.shields.io/badge/Docker-Production%20Ready-2496ED?style=flat&logo=docker&logoColor=white" alt="Docker">
  <img src="https://img.shields.io/badge/Cloudflare-Tunnel%20Supported-F38020?style=flat&logo=cloudflare&logoColor=white" alt="Cloudflare">
  <img src="https://img.shields.io/badge/Tests-14%20Passed%20(100%25)-success" alt="Tests">
  <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License">
</p>

---

## 📑 Daftar Isi
- [📖 Tentang Project](#-tentang-project)
- [✨ Fitur Utama](#-fitur-utama)
- [🏛️ Arsitektur Sistem](#-arsitektur-sistem)
- [💻 Panduan Menjalankan di Lingkungan Development (Lokal)](#-panduan-menjalankan-di-lingkungan-development-lokal)
- [🚀 Panduan Deployment ke Lingkungan Production (VPS)](#-panduan-deployment-ke-lingkungan-production-vps)
  - [1. Kebutuhan Sistem VPS](#1-kebutuhan-sistem-vps)
  - [2. Langkah Deployment Bertahap](#2-langkah-deployment-bertahap)
  - [3. Konfigurasi Nginx di VPS Host](#3-konfigurasi-nginx-di-vps-host)
  - [4. Konfigurasi Cloudflare Tunnel](#4-konfigurasi-cloudflare-tunnel)
  - [5. Monitoring & Pemeliharaan Rutin](#5-monitoring--pemeliharaan-rutin)
- [📡 Integrasi Perangkat Keras ESP32 (PresensiRFID)](#-integrasi-perangkat-keras-esp32-presensirfid)
  - [1. Skema Rangkaian & Pinout Hardware](#1-skema-rangkaian--pinout-hardware)
  - [2. Konfigurasi Wi-Fi & URL Server (Captive Portal)](#2-konfigurasi-wi-fi--url-server-captive-portal)
  - [3. Alur Auto-Detect UID pada Pendaftaran Santri](#3-alur-auto-detect-uid-pada-pendaftaran-santri)
  - [4. Mode Offline & Auto-Sync (NVS Memory)](#4-mode-offline--auto-sync-nvs-memory)
- [🔌 Dokumentasi API Endpoint](#-dokumentasi-api-endpoint)
- [🧪 Pengujian Otomatis (Testing Suite)](#-pengujian-otomatis-testing-suite)
- [🔧 Troubleshooting & FAQ](#-troubleshooting--faq)
- [📄 Lisensi](#-lisensi)

---

## 📖 Tentang Project

**SIPUDA (Sistem Presensi Ubudiyah)** dirancang khusus untuk memonitoring, mencatat, dan mengelola kehadiran santri pada ibadah shalat berjamaah 5 waktu dan kegiatan ubudiyah harian di lingkungan pondok pesantren secara otomatis, teratur, dan transparan.

Sistem terdiri dari dua komponen utama yang saling terintegrasi:
1. **`presensi-ubudiyah` (Web & API Backend)**:
   Dibangun dengan **Laravel 12**, dilengkapi dashboard realtime, manajemen santri dan kamar, konfigurasi batas waktu toleransi shalat dinamis, pemantauan kehadiran, serta pelaporan dan ekspor rekapitulasi presensi (PDF/Excel).
2. **`PresensiRFID` (Perangkat IoT & Firmware)**:
   Firmware mikrokontroler **ESP32** dengan modul **RFID-RC522**, layar **LCD I2C 16x2**, Buzzer nada, LED indikator dual-warna, memori internal NVS untuk pencatatan offline, dan fitur Captive Portal Wi-Fi Manager untuk konfigurasi mandiri tanpa coding ulang.

---

## ✨ Fitur Utama

- ⏱️ **Jadwal Shalat Otomatis Berbasis Koordinat GPS**: Terintegrasi langsung dengan API AlAdhan untuk kalkulasi waktu shalat yang akurat sesuai lintang (*latitude*) dan bujur (*longitude*) lokasi pondok pesantren.
- ⚙️ **Pengaturan Toleransi Shalat Dinamis**:
  - **Jeda Setelah Adzan**: Menunda pembukaan jendela scan (contoh: 10 menit setelah adzan untuk memberikan waktu santri berwudhu, shalat sunnah qobliyah, dan iqamah).
  - **Batas Toleransi Hadir**: Batas waktu status kehadiran dianggap **Tepat Waktu**. Scan setelah batas ini otomatis ditandai **Terlambat**.
  - **Durasi Jendela Scan**: Batas waktu total presensi dibuka sebelum otomatis ditutup saat shalat berjamaah selesai.
- 📶 **Dual-Mode: Online Langsung & Offline Buffering**:
  - *Mode Online*: Scan kartu/gelang langsung dikirim ke server dan dicatat secara realtime.
  - *Mode Offline*: Jika koneksi Wi-Fi atau internet terputus, ESP32 tetap dapat merekam scan santri ke dalam memori flash NVS. Saat koneksi pulih, data otomatis disinkronkan ke server sesuai cap waktu (*timestamp*) aslinya.
- 🔍 **Auto-Detect UID Gelang Santri**: Saat mendaftarkan santri baru di dashboard admin, petugas cukup menempelkan gelang ke reader ESP32. Kolom UID RFID pada form web otomatis terisi tanpa perlu mengetik manual.
- 🌐 **Captive Portal Wi-Fi Manager**: ESP32 memancarkan hotspot mandiri (`SIPUDA-Presensi-Setup`) dengan portal web di `http://192.168.4.1` untuk konfigurasi nama Wi-Fi, password, dan URL server.
- 🔒 **Dukungan Penuh HTTPS & Cloudflare Tunnel**: Dilengkapi konfigurasi `WiFiClientSecure` pada ESP32, `trustProxies` pada Laravel, dan template Nginx reverse proxy dengan pemulihan IP Cloudflare.
- 📊 **Monitoring & Rekap Laporan Lengkap**: Filter presensi berdasarkan kamar, rentang tanggal, jenis shalat, serta status kehadiran (Hadir Tepat Waktu, Terlambat, Izin, Sakit, Alpa) dengan fitur cetak PDF.

---

## 🏛️ Arsitektur Sistem

```text
       [ Gelang RFID Santri ]
                 │ (Tap Kartu / Gelang RFID)
                 ▼
        [ Alat IoT: ESP32 ] ──── (Hotspot Setup: 192.168.4.1)
                 │ (HTTP / HTTPS POST)
                 ▼
     [ Cloudflare Edge Server ]
                 │ (Cloudflare Tunnel: cloudflared)
                 ▼
       [ VPS Host: Nginx ] (Reverse Proxy di Port 80 / 443)
                 │ (proxy_pass http://127.0.0.1:8000)
                 ▼
    [ Docker Compose Network: sipuda_net ]
      ├── 🌐 web       (Nginx Container - 127.0.0.1:8000)
      ├── ⚙️ app       (PHP 8.3-FPM Container - Port 9000)
      ├── ⏰ scheduler (Laravel Scheduler: php artisan schedule:work)
      └── 🗄️ db        (MariaDB 11 Container - Volume: db_data)
```

---

## 💻 Panduan Menjalankan di Lingkungan Development (Lokal)

Gunakan panduan ini jika Anda ingin menjalankan aplikasi di laptop/komputer lokal untuk pengembangan, modifikasi tampilan, atau uji coba dengan ESP32 dalam satu jaringan Wi-Fi lokal.

### 1. Kebutuhan Sistem Lokal
- PHP 8.2 atau lebih baru (ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `gd`, `zip`, `intl`, `bcmath`)
- Composer 2.x
- Node.js v20+ & NPM
- Database Server: MariaDB 10.6+ atau MySQL 8.0+

### 2. Langkah-Langkah Instalasi Lokal

1. **Clone repository:**
   ```bash
   git clone <URL_REPO_ANDA> presensi-ubudiyah
   cd presensi-ubudiyah
   ```

2. **Salin file environment & instal dependensi:**
   ```bash
   cp .env.example .env
   composer install
   npm install
   ```

3. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

4. **Konfigurasi Database di `.env`:**
   Buka file `.env` dan sesuaikan koneksi database lokal Anda:
   ```env
   APP_NAME="SIPUDA"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=presensi_ubudiyah
   DB_USERNAME=root
   DB_PASSWORD=

   # Koordinat Lokasi Pesantren (Default: Jawa Timur)
   PRAYER_LATITUDE=-7.0654
   PRAYER_LONGITUDE=113.6722
   PRAYER_TIMEZONE=Asia/Jakarta
   ```

5. **Buat Database Lokal:**
   Buat database kosong bernama `presensi_ubudiyah` di MySQL / MariaDB lokal Anda:
   ```sql
   CREATE DATABASE presensi_ubudiyah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

6. **Jalankan Migrasi & Seeder Bawaan:**
   ```bash
   php artisan migrate --seed
   ```
   > [!NOTE]
   > Seeder otomatis membuat:
   > - Akun Admin: **`admin@sipuda.com`** | Password: **`password`**
   > - Data Master Kamar (Kamar Abu Bakar, Umar, Utsman, Ali)
   > - Data Master Kegiatan Shalat (Subuh, Dzuhur, Ashar, Maghrib, Isya)
   > - Konfigurasi toleransi shalat default

7. **Buat Symlink Storage:**
   ```bash
   php artisan storage:link
   ```

8. **Kompilasi Asset Frontend:**
   - *Mode Development (dengan Hot Module Replacement):*
     ```bash
     npm run dev
     ```
   - *Mode Build Produksi:*
     ```bash
     npm run build
     ```

9. **Jalankan Server Lokal dengan Akses Jaringan:**
   Jalankan server Laravel dengan opsi `--host=0.0.0.0` agar dapat diakses oleh HP dan alat ESP32 melalui alamat IP Wi-Fi lokal komputer Anda:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```
   *Cek IP lokal Anda (misal `192.168.1.100`), lalu akses melalui browser di `http://192.168.1.100:8000/login`.*

10. **Jalankan Background Worker / Scheduler (Opsional di Lokal):**
    Untuk memperbarui status otomatis atau membersihkan data berkala:
    ```bash
    php artisan schedule:work
    ```

---

## 🚀 Panduan Deployment ke Lingkungan Production (VPS)

Project ini telah dikonfigurasi penuh dengan **Docker Multi-Stage Build**, siap dijalankan di Virtual Private Server (VPS) Ubuntu/Debian di balik **Nginx Host** dan **Cloudflare Tunnel**.

### 1. Kebutuhan Sistem VPS
- VPS Linux (Ubuntu 22.04 LTS / 24.04 LTS atau Debian 12 direkomendasikan)
- RAM minimal 1 GB (2 GB disarankan)
- Docker Engine & Docker Compose v2 (`docker compose version`)
- Nginx Web Server terpasang di host VPS
- Akun Cloudflare dengan Cloudflare Tunnel (`cloudflared`) terkonfigurasi

### 2. Langkah Deployment Bertahap

#### Langkah A: Clone Project ke VPS
```bash
git clone <URL_REPO_ANDA> /opt/presensi-ubudiyah
cd /opt/presensi-ubudiyah
```

#### Langkah B: Siapkan File `.env` Produksi
Salin template konfigurasi produksi yang telah disediakan:
```bash
cp .env.production.example .env
nano .env
```

**Tabel Konfigurasi Penting `.env` Produksi:**

| Variabel | Deskripsi | Contoh Nilai |
|---|---|---|
| `APP_ENV` | Mode environment Laravel | `production` |
| `APP_DEBUG` | Matikan mode debug di server | `false` |
| `APP_URL` | Domain publik Cloudflare | `https://presensi.pesantren.sch.id` |
| `APP_PORT` | Port binding container web ke host | `8000` |
| `DB_DATABASE` | Nama database di container MariaDB | `presensi_ubudiyah` |
| `DB_USERNAME` | Username database aplikasi | `sipuda_user` |
| `DB_PASSWORD` | Password database aplikasi | *(Gunakan password acak yang kuat)* |
| `DB_ROOT_PASSWORD` | Password akun root MariaDB | *(Gunakan password acak yang kuat)* |
| `PRAYER_LATITUDE` | Lintang koordinat pesantren | `-7.0654` |
| `PRAYER_LONGITUDE` | Bujur koordinat pesantren | `113.6722` |
| `PRAYER_TIMEZONE` | Zona waktu wilayah pesantren | `Asia/Jakarta` |

> [!TIP]
> Parameter `APP_KEY` akan otomatis digenerate oleh entrypoint container jika dibiarkan kosong, atau Anda dapat membuatnya sebelum start dengan perintah: `php artisan key:generate --show`.

#### Langkah C: Build & Jalankan Container Docker
Jalankan Docker Compose dalam mode detached:
```bash
docker compose up -d --build
```

Container startup script (`docker/entrypoint.sh`) secara otomatis akan mengeksekusi:
1. Menunggu container MariaDB berstatus *Healthy*.
2. Menjalankan migrasi database (`php artisan migrate --force`).
3. Menjalankan seeder bawaan secara aman & idempoten (`php artisan db:seed --force`).
4. Mengompilasi dan mengunci cache produksi (`config:cache`, `route:cache`, `view:cache`).
5. Mengatur hak akses folder storage dan cache ke user `www-data`.
6. Menjalankan service PHP-FPM dan Laravel Scheduler di container terpisah.

Periksa status container:
```bash
docker compose ps
```
Pastikan seluruh container (`sipuda_app`, `sipuda_web`, `sipuda_db`, `sipuda_scheduler`) berstatus **Up** atau **healthy**.

---

### 3. Konfigurasi Nginx di VPS Host

Gunakan Nginx host sebagai reverse proxy yang meneruskan traffic dari Cloudflare Tunnel ke container Docker (`127.0.0.1:8000`).

1. Buat file konfigurasi virtual host:
   ```bash
   sudo nano /etc/nginx/sites-available/presensi.conf
   ```

2. Tempelkan konfigurasi berikut (sudah dilengkapi IP Cloudflare dan header HTTPS):
   ```nginx
   server {
       listen 80;
       listen [::]:80;
       server_name presensi.pesantren.sch.id; # Ganti dengan domain/subdomain Anda

       client_max_body_size 50M;

       # Daftar Rentang IP Cloudflare Resmi untuk Mengembalikan IP Asli Pengunjung
       set_real_ip_from 173.245.48.0/20;
       set_real_ip_from 103.21.244.0/22;
       set_real_ip_from 103.22.200.0/22;
       set_real_ip_from 103.31.4.0/22;
       set_real_ip_from 141.101.64.0/18;
       set_real_ip_from 108.162.192.0/18;
       set_real_ip_from 190.93.240.0/20;
       set_real_ip_from 188.114.96.0/20;
       set_real_ip_from 197.234.240.0/22;
       set_real_ip_from 198.41.128.0/17;
       set_real_ip_from 162.158.0.0/15;
       set_real_ip_from 104.16.0.0/13;
       set_real_ip_from 104.24.0.0/14;
       set_real_ip_from 172.64.0.0/13;
       set_real_ip_from 131.0.72.0/22;
       real_ip_header CF-Connecting-IP;

       location / {
           proxy_pass http://127.0.0.1:8000;
           proxy_set_header Host $host;
           proxy_set_header X-Real-IP $remote_addr;
           proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
           proxy_set_header X-Forwarded-Proto https;
           proxy_set_header CF-Connecting-IP $http_cf_connecting_ip;

           proxy_connect_timeout 60s;
           proxy_send_timeout 60s;
           proxy_read_timeout 60s;
       }
   }
   ```

3. Aktifkan konfigurasi dan muat ulang Nginx:
   ```bash
   sudo ln -s /etc/nginx/sites-available/presensi.conf /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl reload nginx
   ```

---

### 4. Konfigurasi Cloudflare Tunnel

Jika menggunakan **Cloudflare Zero Trust Dashboard**:
1. Masuk ke **Zero Trust** ➔ **Networks** ➔ **Tunnels**.
2. Pilih Tunnel Anda, lalu tambahkan **Public Hostname**:
   - **Subdomain**: `presensi` (sesuai domain Anda)
   - **Domain**: `pesantren.sch.id`
   - **Service Type**: `HTTP`
   - **URL**: `localhost:80` (mengarahkan ke Nginx host) atau `localhost:8000` (langsung ke container web).
3. Simpan hostname. Domain langsung aktif dengan sertifikat SSL/TLS otomatis dari Cloudflare.

---

### 5. Monitoring & Pemeliharaan Rutin

- **Melihat Log Aplikasi Laravel Realtime:**
  ```bash
  docker compose logs -f app
  ```

- **Melihat Log Web Server Nginx Container:**
  ```bash
  docker compose logs -f web
  ```

- **Mengecek Status Seluruh Container:**
  ```bash
  docker compose ps
  ```

- **Membersihkan / Memperbarui Cache Produksi:**
  ```bash
  docker compose exec app php artisan optimize:clear
  docker compose exec app php artisan optimize
  ```

- **Backup Database MariaDB:**
  ```bash
  docker exec -t sipuda_db mariadb-dump -u sipuda_user -p'PASSWORD_DB_ANDA' presensi_ubudiyah > backup_$(date +%F_%H%M%S).sql
  ```

- **Update Versi Aplikasi dari Git:**
  ```bash
  git pull origin main
  docker compose up -d --build
  ```

---

## 📡 Integrasi Perangkat Keras ESP32 (PresensiRFID)

Direktori firmware mikrokontroler berada di repository pendamping [`PresensiRFID`](file:///home/butterfly_student/projects/work/PresensiRFID).

### 1. Skema Rangkaian & Pinout Hardware

| Modul Hardware | Pin Komponen | Pin ESP32 (GPIO) | Keterangan / Fungsi |
|---|---|---|---|
| **RFID-RC522** | SDA / SS | **GPIO 5** | SPI Chip Select |
| | SCK | **GPIO 18** | SPI Clock |
| | MOSI | **GPIO 23** | SPI Master Out Slave In |
| | MISO | **GPIO 19** | SPI Master In Slave Out |
| | RST | **GPIO 4** | Reset Pin |
| | 3.3V & GND | **3V3 & GND** | **PERHATIAN: Jangan hubungkan ke 5V!** |
| **LCD I2C 16x2** | SDA | **GPIO 21** | I2C Data (Alamat Default: 0x27) |
| | SCL | **GPIO 22** | I2C Clock |
| | VCC & GND | **VIN (5V) & GND** | Daya LCD |
| **Indikator** | BUZZER (+) | **GPIO 25** | Beep konfirmasi scan / error |
| | LED HIJAU (+) | **GPIO 26** | Indikator sukses scan |
| | LED MERAH (+) | **GPIO 27** | Indikator gagal / ditolak |

---

### 2. Konfigurasi Wi-Fi & URL Server (Captive Portal)

Alat presensi tidak memerlukan *hardcoded* SSID maupun IP server pada kode program Arduino:

1. Nyalakan ESP32. Jika Wi-Fi belum tersambung, layar LCD akan menampilkan:
   ```text
   +----------------+
   |AP: SIPUDA-Setup|
   |IP: 192.168.4.1 |
   +----------------+
   ```
2. Dari smartphone atau laptop pengurus, sambungkan ke Wi-Fi Hotspot: **`SIPUDA-Presensi-Setup`**.
3. Buka browser dan kunjungi: **`http://192.168.4.1`**.
4. Portal konfigurasi akan tampil:
   - Pilih nama Wi-Fi pesantren dari daftar scan.
   - Masukkan kata sandi Wi-Fi.
   - Masukkan alamat Server Laravel:
     - *Jika di lingkungan lokal:* `http://192.168.x.x:8000`
     - *Jika di VPS Production:* `https://presensi.pesantren.sch.id` *(Didukung penuh via WiFiClientSecure)*
5. Klik **Simpan & Sambungkan**. ESP32 akan reboot otomatis dan menampilkan alamat IP lokalnya di layar LCD.

---

### 3. Alur Auto-Detect UID pada Pendaftaran Santri

Petugas pesantren tidak perlu mencatat atau mengetik nomor UID kartu secara manual:

```text
[ Admin di Form Tambah Santri ] ──(Polling GET /api/rfid/last-detected)──> [ Server ]
                                                                             ▲
                                                                             │ POST UID
[ Tempel Gelang ke Reader ESP32 ] ───────────────────────────────────────────┘
```

1. Buka dashboard web admin, masuk ke menu **Data Santri** ➔ **Tambah Santri** (`/santri/create`).
2. Tempelkan kartu atau gelang RFID ke reader ESP32.
3. ESP32 mengirimkan UID ke server.
4. Input kolom **UID RFID** di halaman web akan terisi secara otomatis seketika dengan status centang hijau.

---

### 4. Mode Offline & Auto-Sync (NVS Memory)

1. Jika jaringan Wi-Fi pondok tiba-tiba mati saat waktu shalat berjamaah, layar LCD menampilkan indikator `RFID (OFFLINE)`.
2. Santri tetap dapat melakukan tap kartu/gelang seperti biasa.
3. ESP32 menyimpan UID beserta stempel waktu asli (*timestamp* dari RTC/NTP) ke dalam memori flash internal NVS (*Non-Volatile Storage*).
4. Saat sinyal Wi-Fi terhubung kembali, modul sinkronisasi (`sync.cpp`) secara otomatis mengirimkan tumpukan antrean offline ke endpoint `/api/rfid/sync`.
5. Data kehadiran santri tercatat di database server dengan waktu kehadiran asli saat santri melakukan tap di musholla/masjid.

---

## 🔌 Dokumentasi API Endpoint

Seluruh komunikasi antara ESP32 dan backend Laravel menggunakan format pertukaran data JSON:

### 1. Presensi Realtime (Online Tap)
- **Endpoint**: `POST /api/rfid/scan`
- **Request Header**: `Content-Type: application/json`
- **Request Body**:
  ```json
  {
    "uid_rfid": "1B:E0:36:39"
  }
  ```
- **Contoh Respons Sukses (Hadir Tepat Waktu - HTTP 200)**:
  ```json
  {
    "status": "success",
    "message": "Presensi shalat berhasil",
    "nama": "Ahmad Fauzi",
    "kegiatan": "Shalat Subuh",
    "waktu": "04:35:12",
    "status_kehadiran": "Hadir"
  }
  ```
- **Contoh Respons Sukses (Terlambat - HTTP 200)**:
  ```json
  {
    "status": "success",
    "message": "Presensi berhasil dicatat (Terlambat)",
    "nama": "Ahmad Fauzi",
    "kegiatan": "Shalat Subuh",
    "waktu": "04:46:10",
    "status_kehadiran": "Terlambat"
  }
  ```
- **Contoh Respons Ditolak (Di Luar Jendela Shalat - HTTP 400)**:
  ```json
  {
    "status": "error",
    "message": "Presensi shalat subuh belum dibuka. Silakan tunggu hingga adzan selesai."
  }
  ```
- **Contoh Respons Gelang Belum Terdaftar (HTTP 404)**:
  ```json
  {
    "status": "error",
    "message": "RFID tidak terdaftar"
  }
  ```

---

### 2. Sinkronisasi Data Offline (NVS Sync)
- **Endpoint**: `POST /api/rfid/sync`
- **Request Body**:
  ```json
  {
    "uid_rfid": "1B:E0:36:39",
    "tanggal": "2026-10-03",
    "jam_absen": "04:36:20"
  }
  ```
- **Respons (HTTP 200)**:
  ```json
  {
    "status": "success",
    "message": "Data presensi offline berhasil disinkronkan",
    "nama": "Ahmad Fauzi"
  }
  ```

---

### 3. Polling UID Terakhir (Pendaftaran Santri)
- **Endpoint**: `GET /api/rfid/last-detected`
- **Respons (HTTP 200)**:
  ```json
  {
    "status": "success",
    "uid_rfid": "1B:E0:36:39",
    "detected_at": "2026-10-03 10:30:15"
  }
  ```

---

## 🧪 Pengujian Otomatis (Testing Suite)

Aplikasi memiliki rangkaian automated tests yang komprehensif untuk memastikan seluruh alur perhitungan toleransi, pendaftaran, dan API presensi berjalan tanpa celah.

Jalankan pengujian menggunakan PHPUnit bawaan Laravel:
```bash
php artisan test
```

### Ringkasan Cakupan Test (14 Skenario - 100% Lulus):
1. **Unit Test (`PrayerScheduleCalculationTest`)**:
   - Menghitung waktu mulai jendela presensi berdasarkan jeda setelah adzan.
   - Menghitung batas akhir toleransi tepat waktu.
   - Menghitung batas akhir penutupan jendela presensi.
   - Normalisasi variasi nama shalat (subuh, dzuhur, zuhur, ashar, maghrib, isya).
2. **Feature Test (`PengaturanShalatCrudTest`)**:
   - Memastikan halaman pengaturan toleransi shalat terproteksi middleware autentikasi.
   - Validasi batas toleransi tepat waktu tidak boleh melebihi durasi jendela scan.
   - Update pengaturan jeda dan toleransi shalat serta verifikasi cache dibersihkan otomatis.
3. **Feature Test (`RfidPresensiShalatTest`)**:
   - Skenario tap gelang saat jendela presensi belum dibuka (Ditolak).
   - Skenario tap gelang saat jendela terbuka & tepat waktu (Tercatat Hadir).
   - Skenario tap gelang tepat di batas akhir toleransi (Tercatat Hadir).
   - Skenario tap gelang melewati batas toleransi (Tercatat Terlambat).
   - Skenario tap gelang setelah jendela presensi ditutup (Ditolak).
   - Skenario duplikasi tap pada shalat yang sama (Ditolak).
   - Skenario sinkronisasi offline (Tercatat sesuai waktu asli scan pada memori NVS).

---

## 🔧 Troubleshooting & FAQ

### 1. ESP32 Gagal Melakukan POST ke Domain Cloudflare (HTTPS)
* **Penyebab**: Firmware mikrokontroler standar menggunakan `WiFiClient` biasa yang tidak mengenkripsi SSL/TLS port 443.
* **Solusi**: Firmware `PresensiRFID/laravel.cpp` sudah diperbarui menggunakan `WiFiClientSecure` dengan pemanggilan `secureClient.setInsecure()`. Pastikan URL server di Captive Portal diawali dengan `https://`.

### 2. Masalah Redirect Loop atau Error 419 Page Expired di VPS
* **Penyebab**: Laravel berada di balik reverse proxy Cloudflare dan Nginx host tanpa mempercayai header forwarded HTTPS.
* **Solusi**:
  1. Pastikan Nginx host memiliki baris: `proxy_set_header X-Forwarded-Proto https;`.
  2. File `bootstrap/app.php` di repository ini sudah menyertakan `$middleware->trustProxies(at: '*');`.
  3. File `app/Providers/AppServiceProvider.php` telah mengaktifkan `URL::forceScheme('https')` pada environment production.

### 3. Presensi Ditolak dengan Keterangan "Jendela Presensi Belum Dibuka" atau "Telah Ditutup"
* **Penyebab**: Perbedaan jam antara server dan waktu lokal, atau jadwal shalat belum terhitung akurat.
* **Solusi**:
  1. Pastikan zona waktu di `.env` sudah diatur ke `Asia/Jakarta`.
  2. Periksa koordinat `PRAYER_LATITUDE` dan `PRAYER_LONGITUDE` di `.env` sesuai kota/kabupaten pondok pesantren.
  3. Buka menu **Pengaturan Shalat** di dashboard web untuk mengatur menit jeda adzan dan durasi jendela scan.

### 4. Nomor UID Tidak Terisi Otomatis di Form Tambah Santri
* **Solusi**:
  1. Pastikan alat ESP32 terhubung ke Wi-Fi dan berhasil mengirim UID saat kartu ditempelkan (LCD menampilkan pesan "UID Terbaca").
  2. Pastikan komputer/laptop yang membuka dashboard admin berada dalam jaringan yang dapat mengakses URL API server.

---

## 📄 Lisensi

Project ini dilisensikan di bawah lisensi open-source **[MIT License](LICENSE)**. Anda bebas memodifikasi, menggunakan, dan mendistribusikan sistem ini untuk keperluan pesantren dan lembaga pendidikan Islam.
