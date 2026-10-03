#!/bin/sh
set -e

echo "==> [SIPUDA] Memulai proses inisialisasi container Laravel..."

# 1. Pastikan kepemilikan dan permission direktori storage & cache
mkdir -p /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 2. Tunggu Database siap menerima koneksi
echo "==> [SIPUDA] Menunggu koneksi database (${DB_HOST:-db}:${DB_PORT:-3306})..."
max_retries=30
counter=0
until php -r "
try {
    new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
" > /dev/null 2>&1; do
    counter=$((counter + 1))
    if [ $counter -gt $max_retries ]; then
        echo "==> [SIPUDA ERROR] Database tidak dapat dijangkau setelah $max_retries detik. Melanjutkan..."
        break
    fi
    echo "    Menunggu database... ($counter/$max_retries)"
    sleep 1
done

echo "==> [SIPUDA] Database terhubung!"

# 3. Generate APP_KEY jika belum ada di .env
if [ -z "$APP_KEY" ]; then
    echo "==> [SIPUDA] Generate APP_KEY..."
    php artisan key:generate --force
fi

# 4. Storage Link
if [ ! -L /var/www/html/public/storage ]; then
    echo "==> [SIPUDA] Membuat symbolic link storage..."
    php artisan storage:link || true
fi

# 5. Jalankan Database Migration & Seeder
echo "==> [SIPUDA] Menjalankan database migration..."
php artisan migrate --force

echo "==> [SIPUDA] Menjalankan database seeder default (Admin, Kamar, Shalat)..."
php artisan db:seed --force

# 6. Optimasi Cache untuk Production
if [ "$APP_ENV" = "production" ]; then
    echo "==> [SIPUDA] Melakukan caching konfigurasi, route, dan view untuk Production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
else
    echo "==> [SIPUDA] Mode non-production: membersihkan cache..."
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
fi

echo "==> [SIPUDA] Inisialisasi selesai. Menjalankan proses: $@"
exec "$@"
