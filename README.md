# TicketIn : Modern E-Ticketing Event System

![TicketIn Banner](public/img/ticketin.jpg)

**TicketIn** adalah platform manajemen acara dan pemesanan tiket (e-ticketing) berbasis web yang dirancang untuk memfasilitasi untuk mengelola acara (event) yang memungkinkan admin, event organizer, dan pengunjung untuk berinteraksi dengan mudah dalam manajemen acara dan pemesanan tiket. Dibangun dengan Laravel 12, pada aplikasi ini admin memiliki akses penuh untuk mengelola acara, pengguna, dan melihat laporan penjualan, sementara organizer dapat menambah, memperbarui, serta melihat pemesanan untuk acara mereka. Pengunjung terdaftar dapat memesan tiket, melihat riwayat pemesanan, serta menyimpan acara favorit.

---

## 📋 Daftar Isi
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi & Konfigurasi](#-instalasi--konfigurasi)
- [Panduan Penggunaan (User Guide)](#-panduan-penggunaan-user-guide)
- [Struktur Proyek](#-project-structure)
- [Lisensi](#-lisensi)

---

## ⚙️ Fitur Utama

### 1. Multi-User & Role Management
- **Admin:** Superuser dengan kontrol penuh (CRUD User, Approve Organizer, Hapus Event, Laporan Global).
- **Event Organizer (EO):** Manajemen acara mandiri, monitoring penjualan, approval peserta manual.
- **User:** Pencarian acara, booking tiket, riwayat transaksi, tiket digital, dan sistem favorit.
- **Guest:** Akses publik untuk melihat katalog acara.

### 2. Manajemen Acara Canggih
- **Multi-Ticket System:** Satu acara bisa memiliki banyak jenis tiket (VIP, Regular, Early Bird) dengan harga dan kuota berbeda.
- **Rich Event Details:** Deskripsi lengkap, lokasi, waktu, dan banner visual.
- **Validasi Ketat:** Mencegah overbooking dan input data yang tidak valid.

### 3. Sistem Booking & Approval
- **Alur Transaksi Aman:** Booking mengurangi kuota secara *real-time* (Database Transaction).
- **Manual Approval:** Organizer memiliki kendali penuh untuk menyetujui atau menolak pesanan masuk.
- **Tiket Digital:** E-Ticket otomatis terbit setelah disetujui, dilengkapi QR Code simulasi dan fitur cetak (Print-friendly).

### 4. Review & Rating
- **Sistem ulasan**: Hanya pengguna yang telah membeli tiket dan statusnya *Approved* yang bisa memberikan rating bintang dan komentar.

### 5. Laporan & Analitik
- **Dashboard analitik:** Ringkasan visual total pendapatan dan tiket terjual.
- **Laporan Detail:** Tabel rinci per event untuk Organizer dan Admin.

---

## 🛠 Teknologi yang Digunakan

- **Backend:** Laravel 12 (PHP Framework)
- **Database:** MySQL
- **Frontend:** Blade Templating, Tailwind CSS (v3)
- **Scripting:** Alpine.js
- **Authentication:** Laravel Breeze

---

## 💻 Persyaratan Sistem

Sebelum memulai, pastikan sistem Anda memenuhi syarat berikut:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database

---

## 🚀 Instalasi & Konfigurasi

Ikuti langkah-langkah ini untuk menjalankan proyek di komputer lokal Anda:

### 1. Clone Repository

```bash
git clone https://github.com/rnratika/ticketin.git
cd ticketin
```

### 2. Install Dependencies

```bash
# Install paket PHP dan JavaScript yang dibutuhkan.
composer install
npm install
```
### 3. Konfigurasi Environment

Salin file .env.example menjadi .env dan sesuaikan konfigurasi database Anda.
```bash
cp .env.example .env
```

Buka file .env dan ubah bagian ini:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticketin_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
### 4. Generate Key & Migrate

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

### 5. Jalankan Aplikasi

```bash
# Build Frontend
npm run dev

# Jalankan Server
php artisan serve
```
Akses aplikasi di browser melalui: http://127.0.0.1:8000

---

## 📖 Panduan Penggunaan (User Guide)

### A. Login Akun Demo

Setelah anda menjalankan seeder, login dengan akun berikut.

**Super Admin:** 
- email: admin@ticketin.com
- password : password

**Event Organizer:** 
- email: eo@ticketin.com
- password : password

**User:** 
- email: user@ticketin.com
- password : password

### B. Alur Kerja Utama (Workflow)

**1. Registrasi Event Organizer (EO) Baru**
- Buka halaman Register.
- Isi data diri dan pilih "Daftar Sebagai: Event Organizer".
- Setelah daftar, Anda akan diarahkan ke halaman "Menunggu Persetujuan".
- Login sebagai Admin -> Masuk ke menu Users -> Klik Approve pada user tersebut.
- EO baru sekarang bisa login dan membuat event.

**2. Membuat Acara (Organizer)**
- Login sebagai Organizer.
- Masuk ke menu My Events -> Klik Buat Event Baru.
- Isi detail acara, upload banner, dan tambahkan jenis tiket (bisa lebih dari satu).
- Klik Simpan. Acara langsung tayang di halaman depan.

**3. Memesan Tiket (User)**
- Login sebagai User.
- Pilih acara di Halaman Depan -> Klik Beli Tiket.
- Masukkan jumlah tiket -> Klik Beli.
- Status pesanan akan menjadi Pending.

**4. Verifikasi Pesanan (Organizer)**
- Organizer melihat notifikasi/laporan di menu Sales atau My Events.
- Klik tombol Lihat Peserta pada event terkait.
- Klik Approve (Centang Hijau) untuk menerima pesanan.
- Stok tiket otomatis berkurang permanen.

**5. Mengakses Tiket Digital (User)**
- User kembali ke menu My Tickets.
- Status berubah menjadi Berhasil.
- Klik tombol Lihat E-Ticket.
- Tiket digital dengan QR Code muncul dan siap dicetak (Klik tombol "Cetak Tiket").

---

## 💾 Struktur Proyek
```
ticketin/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── AdminEventController.php
│   │   │   │   └── AdminUserController.php
│   │   │   ├── Auth/                  
│   │   │   ├── Organizer/             
│   │   │   │   ├── OrganizerEventController.php
│   │   │   │   ├── OrganizerReportController.php
│   │   │   │   └── OrganizerStatusController.php
│   │   │   ├── BookingController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── FavoriteController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ProfileController.php
│   │   │   └── ReviewController.php 
│   │   └── Middleware/
│   │       ├── EnsureOrganizerActive.php
│   │       └── RoleMiddleware.php
│   │   └── Requests/
│   └── Models/
│       ├── Booking.php
│       ├── Event.php
│       ├── Review.php
│       ├── Ticket.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── css/
│   ├── js/
│   ├── views/
│   │   ├── admin/
│   │   ├── auth/
│   │   ├── bookings/
│   │   ├── components/
│   │   ├── events/
│   │   ├── favorites/
│   │   ├── layouts/
│   │   ├── organizer/
│   │   ├── profile/
│   │   ├── dashboard.blade.php
│   │   └── home.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 🔖 Lisensi
- Desain UI: Custom Tailwind CSS dengan tema Glassmorphism.
- Icons: Heroicons (via SVG).
- Font: Poppins (Google Fonts).
- Images: Aset Pribadi (Disimpan di folder public/img).

<div align="center">
&copy; 2025 TicketIn. All rights reserved.
</div>








