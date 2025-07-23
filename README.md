# Aplikasi Parkir Modern

Aplikasi Parkir Modern berbasis Laravel dengan fitur lengkap dan tampilan elegan. Mendukung manajemen parkir, scan barcode, dashboard statistik, laporan, dan user management berbasis role (admin & petugas).

## Fitur Utama
- **Dashboard Statistik**: Info total parkir, masuk/keluar hari ini, masih parkir.
- **Scan Barcode**: Proses masuk/keluar kendaraan dengan scan barcode tiket.
- **Input Parkir Masuk**: Form input manual untuk kendaraan masuk.
- **Data Parkir**: Tabel data parkir lengkap, detail tiket, print barcode, dan biaya parkir.
- **Laporan**: Rekap data parkir, filter tanggal, export.
- **User Management**: Admin & petugas, role-based access.
- **UI/UX Modern**: Glassmorphism, neon, responsif, animasi.

## Instalasi
1. **Clone repository**
   ```bash
   git clone https://github.com/Jade1-arc/parkir-laravel.git
   cd parkir-laravel
   ```
2. **Install dependency**
   ```bash
   composer install
   npm install && npm run build
   ```
3. **Copy file environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Atur koneksi database** di file `.env` (MySQL recommended).
5. **Migrasi dan seed database**
   ```bash
   php artisan migrate --seed
   ```
6. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

## Cara Pakai
- **Login** sebagai admin/petugas.
- **Dashboard**: Lihat statistik parkir.
- **Scan Barcode**: Proses masuk/keluar kendaraan dengan scan.
- **Data Parkir**: Kelola data, print tiket, cek biaya.
- **Laporan**: Export rekap data parkir.

## Kontribusi
Pull request dan issue sangat diterima untuk pengembangan lebih lanjut.

---
Aplikasi ini dikembangkan dengan ❤️ oleh Jade1-arc dan kontributor.

## Tampilan Aplikasi

### Landing Page
![Landing Page](public/screenshots/landing.png)

### Dashboard Petugas
![Dashboard Petugas](public/screenshots/dashboard.png)

### Scan Barcode
![Scan Barcode](public/screenshots/scan.png)

### Data Parkir
![Data Parkir](public/screenshots/dataparkir.png)
