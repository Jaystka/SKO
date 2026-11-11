# SKO — Toko Sepatu Lokal

Aplikasi e-commerce sepatu lokal berbasis **Laravel 11**, pembayaran **Midtrans Snap**, dan frontend Blade + Tailwind CSS.

## Fitur

- **Storefront**: beranda, shop per brand, pencarian (paginasi), detail produk dengan stok per ukuran.
- **Customer**: registrasi/login (rate-limited), profil, keranjang (validasi stok), checkout dengan alamat wilayah Indonesia, pembayaran Midtrans.
- **Admin** (`/admin`): dashboard pendapatan, CRUD produk + stok per ukuran + upload gambar, kategori, material, daftar customer, daftar penjualan dengan filter status.
- **Pembayaran**: webhook Midtrans terverifikasi signature, status idempoten, stok dikurangi otomatis saat pembayaran lunas.

## Kebutuhan

- PHP 8.2+ (ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd`)
- Composer 2
- MySQL 8 / MariaDB 10.6+
- Node.js 18+ (hanya untuk build ulang CSS/JS)

## Setup lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
# isi DB_*, MIDTRANS_* (kunci sandbox), ADMIN_EMAIL, ADMIN_PASSWORD di .env
php artisan migrate
php artisan db:seed            # kurir, pajak default, akun admin (+ produk demo bila APP_ENV=local)
php artisan serve
```

Build ulang aset (setelah mengubah kelas Tailwind di view):

```bash
npm install
npm run prod
```

> Beberapa utilitas baru sementara didefinisikan di `public/dist/css/sko.css` agar tampilan benar tanpa rebuild. Setelah `npm run prod`, kelas yang sama juga dihasilkan oleh Tailwind.

## Konfigurasi Midtrans

1. Isi `MIDTRANS_SERVER_KEY` dan `MIDTRANS_CLIENT_KEY` (sandbox untuk staging, produksi untuk live).
2. Set `MIDTRANS_IS_PRODUCTION=true` hanya di server produksi — URL `snap.js` otomatis mengikuti.
3. Di dashboard Midtrans → *Settings → Payment → Notification URL*, isi:
   ```
   https://<domain-anda>/payment/notification
   ```
   URL lama `/payment/midtrans-notification` tetap didukung.

Status transaksi disimpan sesuai status Midtrans (`pending`, `settlement`, `capture`, `expire`, `cancel`, `deny`, ...). Stok berkurang satu kali saat transaksi pertama kali berstatus lunas (`settlement`/`capture` dengan fraud `accept`).

## Deploy produksi

Push ke `main` menjalankan workflow `LARAVEL_CI-CD_MAIN`: test → `composer install --no-dev` → upload FTP.

Setelah deploy pertama dengan versi ini, jalankan di server (SSH / terminal cPanel):

```bash
# 1. BACKUP database terlebih dahulu!
mysqldump -u USER -p NAMA_DB > backup-$(date +%F).sql

# 2. Migrasi — aman untuk database lama: hanya membuat tabel/kolom yang belum ada
php artisan migrate --force

# 3. Data referensi + akun admin (idempoten)
php artisan db:seed --force

# 4. Optimasi
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Checklist `.env` produksi:

| Variabel | Nilai |
|---|---|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://domain-anda` (HTTPS dipaksa otomatis) |
| `LOG_LEVEL` | `warning` |
| `SESSION_SECURE_COOKIE` | `true` |
| `MIDTRANS_IS_PRODUCTION` | `true` |

Folder yang harus bisa ditulis web server: `storage/`, `bootstrap/cache/`, `public/dist/img/products/` (gambar produk hasil upload).

### Catatan migrasi dari versi lama

- Stored procedure `cart_insert` (lihat `zquery/QUERY_SKO.txt`) **tidak lagi dipakai**; logika keranjang kini ada di `App\Services\CartService`. Prosedur boleh dibiarkan atau dihapus dari database.
- Order ID baru berformat `SKO-YYMMDDhhmmss-XXXXXX`. Migrasi `reconcile_sko_schema` mengubah kolom `transaction_id` menjadi string bila sebelumnya integer; data lama tetap utuh.
- Pengeluaran via `GET /logout` dinonaktifkan (rawan CSRF); gunakan tombol Logout (POST).

## Testing

```bash
php artisan test
```

Test memakai SQLite in-memory dan payment gateway palsu (tidak memanggil Midtrans). Cakupan: halaman publik, auth & rate limit, otorisasi keranjang antar customer, checkout (total = tagihan Midtrans, rollback bila Midtrans gagal), webhook (signature, idempotensi stok), admin CRUD & upload, proxy wilayah, serta upgrade dari skema database lama.

## Struktur penting

```
app/Services/CartService.php            logika keranjang + validasi stok
app/Services/CheckoutService.php        pembuatan order atomik + Snap token
app/Services/PaymentStatusService.php   penerapan status Midtrans (idempoten)
app/Services/Payment/                   abstraksi gateway (MidtransGateway)
app/Support/IdGenerator.php             ID berurutan (C0001, P0001, PY001) yang portabel
app/Http/Middleware/SecurityHeaders.php header keamanan HTTP
database/migrations/                    skema lengkap (idempoten terhadap DB lama)
```
