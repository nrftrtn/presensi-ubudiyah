# 🚀 Panduan Deployment SIPUDA (Production Ready via Docker, Nginx & Cloudflare Tunnel)

Panduan ini menjelaskan langkah demi langkah cara men-deploy project **SIPUDA (Presensi Ubudiyah)** ke VPS menggunakan **Docker Compose**, **Nginx Host**, dan **Cloudflare Tunnel**.

---

## 🏗️ Arsitektur Sistem di VPS

```
Internet / ESP32 / Browser
         │ (HTTPS / SSL)
         ▼
[ Cloudflare Edge ]
         │ (Cloudflare Tunnel: cloudflared)
         ▼
[ VPS Host: Nginx Reverse Proxy ] (Listening di port 80 / domain)
         │ (HTTP proxy_pass http://127.0.0.1:8000)
         ▼
[ Docker Network: sipuda_net ]
  ├── 🌐 web (Nginx Container - Port 127.0.0.1:8000)
  ├── ⚙️ app (PHP 8.3 FPM Container - Port 9000)
  ├── ⏰ scheduler (Laravel Scheduler - Background Worker)
  └── 🗄️ db (MariaDB 11 Container - Volume: db_data)
```

---

## 📋 Langkah-Langkah Deployment di VPS

### 1. Salin atau Clone Project ke VPS
Masuk ke terminal VPS Anda dan letakkan project di direktori yang diinginkan (misal: `/opt/presensi-ubudiyah` atau `~/presensi-ubudiyah`):
```bash
git clone <URL_REPO_ANDA> /opt/presensi-ubudiyah
cd /opt/presensi-ubudiyah
```

---

### 2. Siapkan File Konfigurasi `.env`
Salin template konfigurasi production:
```bash
cp .env.production.example .env
```

Buka dan sesuaikan isinya:
```bash
nano .env
```
Hal penting yang harus disesuaikan:
* `APP_URL`: Masukkan domain/subdomain Anda, contoh: `https://presensi.pesantren.sch.id`
* `DB_PASSWORD`: Buat password database yang aman.
* `DB_ROOT_PASSWORD`: Buat password root MariaDB yang aman.
* `PRAYER_LATITUDE` & `PRAYER_LONGITUDE`: Koordinat lokasi pesantren Anda agar waktu adzan akurat.

*(Catatan: `APP_KEY` akan digenerate otomatis oleh script entrypoint jika dibiarkan kosong).*

---

### 3. Build & Jalankan Container Docker
Jalankan perintah berikut:
```bash
docker compose up -d --build
```

Container secara otomatis akan melakukan:
1. Mengompilasi asset frontend (Tailwind/Vite) & dependensi PHP produksi (OPcache aktif).
2. Menghubungkan database MariaDB.
3. Menjalankan migrasi database (`php artisan migrate --force`).
4. Menjalankan seeder otomatis:
   * Akun Admin: **`admin@sipuda.com`** / Password: **`password`**
   * Data Kamar Bawaan (Abu Bakar, Umar, Utsman, Ali)
   * Data Kegiatan Shalat 5 Waktu (Subuh, Dzuhur, Ashar, Maghrib, Isya)
   * Pengaturan jeda & toleransi shalat bawaan
5. Melakukan caching konfigurasi, route, dan view untuk kecepatan maksimal.

Periksa status container:
```bash
docker compose ps
```
Pastikan semua statusnya `Up` atau `healthy`.

---

### 4. Konfigurasi Nginx di VPS Host
Buka konfigurasi Nginx di VPS host Anda:
```bash
sudo nano /etc/nginx/sites-available/presensi.conf
```
Gunakan konfigurasi berikut (sudah disesuaikan dengan Cloudflare Tunnel):
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name presensi.pesantren.sch.id; # Ganti dengan domain Anda

    client_max_body_size 50M;

    # Daftar IP Cloudflare agar IP asli pengunjung terdeteksi
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

Aktifkan konfigurasi dan reload Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/presensi.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

### 5. Konfigurasi Cloudflare Tunnel
Pada dashboard **Cloudflare Zero Trust** (Networks ➔ Tunnels) atau file `config.yml` `cloudflared`:
1. Tambahkan **Public Hostname**:
   * **Subdomain**: `presensi` (atau domain Anda)
   * **Domain**: `pesantren.sch.id`
   * **Service Type**: `HTTP`
   * **URL**: `localhost:80` (atau `localhost:8000` jika langsung mengarah ke container web)
2. Simpan pengaturan. Domain Anda sekarang sudah aktif dengan SSL/HTTPS otomatis dari Cloudflare!

---

### 6. Menghubungkan Alat ESP32 ke Server VPS
Karena di firmware ESP32 sudah ada fitur **Captive Portal / Wi-Fi Manager**:

1. Nyalakan alat ESP32.
2. Dari HP, sambungkan ke Wi-Fi Hotspot: **`SIPUDA-Presensi-Setup`**.
3. Buka browser HP ke: **`http://192.168.4.1`**.
4. Di kolom **Alamat Server Laravel**, masukkan alamat domain Anda:
   * Jika menggunakan HTTP Cloudflare Tunnel:
     `http://presensi.pesantren.sch.id`
   * Jika menggunakan HTTPS:
     `https://presensi.pesantren.sch.id`
5. Masukkan nama Wi-Fi pesantren & passwordnya, lalu klik **Simpan & Sambungkan**.
6. ESP32 otomatis tersambung ke server VPS Anda!

---

## 🛠️ Perintah Berguna (Maintenance)

* **Melihat Log Aplikasi:**
  ```bash
  docker compose logs -f app
  ```

* **Melihat Log Web Nginx:**
  ```bash
  docker compose logs -f web
  ```

* **Restart Aplikasi:**
  ```bash
  docker compose restart
  ```

* **Backup Database:**
  ```bash
  docker exec -t sipuda_db mariadb-dump -u sipuda_user -p'PASSWORD_ANDA' presensi_ubudiyah > backup_$(date +%F).sql
  ```
