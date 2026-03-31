# 🌸 Toko Bunga Wilis

<div align="center">

<img src="https://readme-typing-svg.demolab.com?font=Fira+Code&size=32&duration=2800&pause=2000&color=27AE60&center=true&vCenter=true&width=500&lines=%F0%9F%8C%B8+Toko+Bunga+Wilis;%F0%9F%9B%8D%EF%B8%8F+E-Commerce+Tanaman;%F0%9F%9A%80+Powered+by+Laravel" alt="Typing SVG" />

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

[![Visitors](https://komarev.com/ghpvc/?username=TinoNurcahya&label=Visitors&color=blue&style=flat)](https://github.com/TinoNurcahya/proyek2-toko-bunga-wilis)
![GitHub Stars](https://img.shields.io/github/stars/TinoNurcahya/proyek2-toko-bunga-wilis?style=social)
![GitHub Forks](https://img.shields.io/github/forks/TinoNurcahya/proyek2-toko-bunga-wilis?style=social)

</div>

**Toko Bunga Wilis** adalah website **e-commerce toko bunga & tanaman** berbasis **Laravel** yang memungkinkan pengguna mencari, memilih, dan membeli tanaman secara online dengan fitur lengkap seperti sistem keranjang, checkout, simulasi pembayaran menggunakan Midtrans, ulasan produk, notifikasi real-time, serta dashboard admin yang komprehensif.

🔗 **Repository**: [GitHub - proyek2-toko-bunga-wilis](https://github.com/TinoNurcahya/proyek2-toko-bunga-wilis)

---

## 📋 Daftar Isi

- [🎯 Deskripsi Proyek](#-deskripsi-proyek)
- [👥 Role Pengguna & Fitur](#-role-pengguna--fitur)
- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Teknologi & Dependencies](#-teknologi-dependencies)
- [📁 Struktur Proyek](#-struktur-proyek)
- [⚙️ Instalasi & Setup](#-instalasi--setup)
- [🚀 Running & Development](#-running--development)
- [🗄️ Konfigurasi Environment](#-konfigurasi-environment)
- [📊 Database Schema](#-database-schema)
- [🖼️ Preview Aplikasi](#-preview-aplikasi)
- [📖 Panduan Penggunaan](#-panduan-penggunaan)
- [🔑 Akun Demo](#-akun-demo)
- [⚠️ Troubleshooting](#-troubleshooting)
- [📝 Catatan Pengembang](#-catatan-pengembang)
- [📄 Lisensi](#-lisensi)
- [👨‍💼 Tim Pengembang](#-tim-pengembang)

---

## 🎯 Deskripsi Proyek

**Toko Bunga Wilis** adalah website penjualan tanaman bunga yang dibangun untuk memenuhi kebutuhan **Proyek Akhir Semester (Proyek 2)** di Perguruan Tinggi. Aplikasi ini dikembangkan dengan standar industri modern dan dilengkapi dengan fitur e-commerce yang lengkap.

Aplikasi ini memiliki **2 role pengguna utama (Admin & Regular User)** dan dirancang untuk memberikan pengalaman berbelanja yang mulus, serta mengelola operasional toko secara efisien melalui dashboard admin yang intuitif.

### Tujuan Proyek

- Memberikan platform e-commerce yang user-friendly untuk penjualan tanaman
- Mengintegrasikan payment gateway (Midtrans) untuk transaksi online
- Menyediakan sistem manajemen admin yang komprehensif
- Menerapkan best practices dalam web development menggunakan Laravel

---

## 👥 Role Pengguna & Fitur

### 🔹 **ROLE: USER (Pengguna Biasa)**

#### Fitur Autentikasi

- ✅ Registrasi akun baru dengan validasi email
- ✅ Login dengan email dan password
- ✅ Login menggunakan akun Google (OAuth)
- ✅ Forgot password dengan reset link
- ✅ Verifikasi email

#### Fitur Produk & Pencarian

- ✅ Melihat daftar semua produk tanaman & detail produk lengkap (deskripsi, harga, foto)
- ✅ Filter produk berdasarkan kategori
- ✅ Pencarian produk (search bar)
- ✅ Melihat pilihan ukuran produk dan harga per ukuran
- ✅ Melihat photo gallery produk dengan PhotoSwipe
- ✅ Melihat petunjuk perawatan tanaman

#### Fitur Keranjang & Checkout

- ✅ Tambah produk ke keranjang dengan pilihan ukuran
- ✅ View detail keranjang (sidebar & halaman khusus)
- ✅ Menghapus produk dari keranjang
- ✅ Melakukan checkout
- ✅ Mengisi form pemesanan (nama, email, alamat, telepon, dll)
- ✅ Lihat total harga dan detailed breakdown harga

#### Fitur Pembayaran

- ✅ Simulasi pembayaran menggunakan **Midtrans (Sandbox mode)**
- ✅ Notifikasi pembayaran berhasil/gagal
- ✅ Riwayat pesanan dengan status real-time

#### Fitur Ulasan & Rating

- ✅ Membuat review/ulasan produk yang sudah dibeli
- ✅ Memberikan rating bintang (1-5 stars)
- ✅ Mengedit & Menghapus ulasan milik sendiri
- ✅ Melihat review dari pengguna lain

#### Fitur Profil & Akun

- ✅ Mengubah data profil (foto profil, nama, telepon, dll)
- ✅ Manajemen alamat pengiriman
- ✅ Logout

#### Fitur Notifikasi

- ✅ Menerima notifikasi pesanan (baru, diproses, dibayar, dll)
- ✅ Melihat daftar notifikasi
- ✅ Mark notifikasi sebagai read/unread

#### Fitur Tambahan

- ✅ Lihat testimonial pelanggan
- ✅ Lihat jam operasional toko
- ✅ Lihat informasi kontak toko

---

### 🔹 **ROLE: ADMIN (Administrator)**

#### Dashboard

- ✅ Dashboard dengan overview statistik
- ✅ Notifikasi pesanan masuk real-time

#### Manajemen Produk

- ✅ Manajemen produk (CRUD, galeri foto, ukuran & harga)
- ✅ Manajemen kategori & petunjuk perawatan

#### Manajemen Pesanan

- ✅ Manajemen pesanan (daftar, detail, update status)
- ✅ Filtering, pencarian & export data

#### Manajemen Review/Ulasan

- ✅ Melihat semua review produk
- ✅ Menghapus review yang tidak sesuai
- ✅ Set review featured/highlight
- ✅ Statistik rating produk

#### Manajemen User

- ✅ **Manajemen User** - Lihat daftar & detail user, ubah status, hapus user, lihat histori pembelian

#### Pengaturan Sistem

- ✅ **Pengaturan Sistem** - Konfigurasi pembayaran (Midtrans), informasi toko, pengaturan email, manajemen admin

---

## ✨ Fitur Utama

### 🎨 **Frontend Features**

- ✅ **Responsive Design** - Optimal viewing di desktop, tablet, mobile
- ✅ **Autentikasi Modern** - Laravel Breeze + Google OAuth2
- ✅ **Animasi Interaktif** - AOS (Animate On Scroll) untuk scroll animations
- ✅ **Parallax Effect** - Rellax.js untuk depth effect
- ✅ **Carousel/Slider** - Swiper.js untuk product gallery
- ✅ **Image Gallery** - PhotoSwipe untuk lightbox gallery
- ✅ **UI Framework** - Bootstrap 5 dengan custom styling
- ✅ **Icons** - Font Awesome 6 untuk comprehensive icon set

### 🔧 **Backend Features**

- ✅ **MVC Architecture** - clean code structure
- ✅ **ORM & Query Builder** - Eloquent ORM
- ✅ **Authentication & Authorization** - Laravel Auth + Middleware
- ✅ **API Integration** - Midtrans Payment Gateway (Sandbox)
- ✅ **Notification System** - Real-time order notifications
- ✅ **Email Service** - Email verification & order notifications
- ✅ **Database Migration** - Versionable schema dengan seeding
- ✅ **File Upload** - Product images dengan storage management
- ✅ **Form Validation** - Server-side validation dengan Form Requests
- ✅ **Search & Filter** - Advanced product filtering

### 💳 **E-Commerce Features**

- ✅ **Shopping Cart** - Persistent cart dengan session/database
- ✅ **Checkout Flow** - Multi-step checkout process
- ✅ **Payment Integration** - Midtrans sandbox untuk simulasi pembayaran
- ✅ **Order Management** - Track order status dari create hingga selesai
- ✅ **Product Rating & Review** - User reviews dengan rating system
- ✅ **Inventory** - Product stock management dengan variants

### 🔐 **Security Features**

- ✅ **CSRF Protection** - Laravel built-in CSRF tokens
- ✅ **Password Hashing** - Bcrypt hashing
- ✅ **Input Validation** - Extensive server-side validation
- ✅ **Authorization** - Role-based access control
- ✅ **SQL Injection Protection** - Parameterized queries via Eloquent

---

## 🛠️ Teknologi & Dependencies

### **Backend Stack**

| Technology | Version | Purpose              |
| ---------- | ------- | -------------------- |
| PHP        | >= 8.3  | Server-side language |
| Laravel    | 11.x    | Web framework        |
| MySQL      | 5.7+    | Database             |
| Composer   | Latest  | PHP package manager  |

### **Frontend Stack**

| Technology        | Purpose        |
| ----------------- | -------------- |
| HTML5             | Markup         |
| CSS3/SCSS         | Styling        |
| JavaScript (ES6+) | Interactivity  |
| Bootstrap         | CSS Framework  |
| Node.js           | JS runtime     |
| npm/Vite          | Asset bundling |

### **Key PHP Packages**

```
- laravel/framework (core)
- laravel/breeze (authentication)
- laravel/socialite (Google OAuth)
- midtrans/midtrans-php (payment gateway)
- guzzlehttp/guzzle (HTTP client)
- nesbot/carbon (date/time helper)
```

### **Key JavaScript Libraries**

```
- Bootstrap 5 - CSS framework
- Swiper.js - Carousel/slider
- AOS - Scroll animations
- Rellax.js - Parallax effect
- PhotoSwipe - Image lightbox
- Font Awesome 6 - Icons
```

### **Development Tools**

| Tool         | Purpose            |
| ------------ | ------------------ |
| Vite         | Asset bundler      |
| Laravel Sail | Docker development |
| PHPUnit      | Testing framework  |
| Pint         | Code formatter     |

---

## 📁 Struktur Proyek

```
proyek2-toko-bunga-wilis/
│
├── 📂 app/
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/         # Application controllers
│   │   ├── 📂 Middleware/          # HTTP middleware
│   │   └── 📂 Requests/            # Form request classes
│   ├── 📂 Livewire/                # Livewire components
│   ├── 📂 Models/                  # Eloquent models
│   │   ├── 📄 Produk.php           # Product model
│   │   ├── 📄 Kategori.php         # Category model
│   │   ├── 📄 Pesanan.php          # Order model
│   │   ├── 📄 Review.php           # Review model
│   │   ├── 📄 User.php             # User model
│   │   └── 📄 ...
│   ├── 📂 Services/                # Business logic services
│   │   └── 📄 MidtransService.php  # Payment service
│   └── 📂 Providers/               # Service providers
│
├── 📂 bootstrap/                   # Bootstrap files
├── 📂 config/                      # Configuration files
│   ├── 📄 app.php
│   ├── 📄 auth.php
│   ├── 📄 database.php
│   └── 📄 services.php
│
├── 📂 database/
│   ├── 📂 migrations/              # Database migrations
│   ├── 📂 seeders/                 # Database seeders
│   └── 📂 factories/               # Model factories
│
├── 📂 public/
│   ├── 📄 index.php                # Entry point
│   ├── 📂 images/                  # Static images
│   ├── 📂 uploads/                 # Uploaded files
│   └── 📂 build/                   # Compiled assets
│
├── 📂 resources/
│   ├── 📂 views/                   # Blade templates
│   ├── 📂 js/                      # JavaScript files
│   └── 📂 scss/                    # Stylesheet files
│
├── 📂 routes/
│   ├── 📄 web.php                  # Web routes
│   ├── 📄 auth.php                 # Auth routes (Breeze)
│   └── 📄 console.php              # Console routes
│
├── 📂 storage/
│   ├── 📂 app/                     # Application storage
│   ├── 📂 logs/                    # Application logs
│   └── 📂 framework/               # Framework files
│
├── 📂 tests/
│   ├── 📂 Feature/                 # Feature tests
│   └── 📂 Unit/                    # Unit tests
│
├── 📂 vendor/                      # Composer dependencies
├── 📂 docs/                        # Documentation & screenshots
│
├── 📄 artisan                      # Laravel CLI
├── 📄 composer.json                # PHP dependencies
├── 📄 package.json                 # NPM dependencies
├── 📄 vite.config.js               # Vite configuration
├── 📄 phpunit.xml                  # PHPUnit configuration
├── 📄 .env.example                 # Environment template
├── 📄 README.md                    # This file
└── 📄 ...
```

---

## ⚙️ Instalasi & Setup

### ✅ Prasyarat Sistem

Sebelum memulai, pastikan Anda memiliki:

- **PHP 8.3+** dengan extension: `mbstring`, `json`, `xml`, `curl`, `sqlite3`, `pdo_mysql`, `gd`
- **Composer** (package manager PHP)
- **Node.js 18+** dan npm/yarn
- **MySQL 5.7+** atau MariaDB
- **Git**

### 📥 Langkah-Langkah Instalasi

#### **Step 1: Clone Repository**

```bash
git clone https://github.com/TinoNurcahya/proyek2-toko-bunga-wilis.git
cd proyek2-toko-bunga-wilis
```

#### **Step 2: Install Dependencies Backend**

```bash
composer install
```

#### **Step 3: Install Dependencies Frontend**

```bash
npm install
```

#### **Step 4: Setup Environment**

```bash
# Copy environment template
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### **Step 5: Configure Environment File (.env)**

Edit file `.env` dan perbarui konfigurasi berikut:

```env
# ------- APP CONFIG -------
APP_NAME="Toko Bunga Wilis"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# ------- DATABASE CONFIG -------
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proyek2_toko_bunga_wilis
DB_USERNAME=root
DB_PASSWORD=

# ------- MAIL CONFIG (Optional - untuk email verification) -------
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=noreply@tokobungawilis.local
MAIL_FROM_NAME="Toko Bunga Wilis"

# ------- GOOGLE OAUTH CONFIG -------
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# ------- MIDTRANS CONFIG (Payment) -------
MIDTRANS_MERCHANT_ID=your_midtrans_merchant_id
MIDTRANS_CLIENT_KEY=your_midtrans_client_key
MIDTRANS_SERVER_KEY=your_midtrans_server_key
MIDTRANS_IS_PRODUCTION=false

# ------- FORMSPREE CONFIG (Contact Form) -------
FORMSPREE_ID=your_formspree_form_id
```

#### **Step 6: Database Migration & Seeding**

```bash
# Create database tables
php artisan migrate

# Seed dummy data (PENTING untuk development)
php artisan db:seed
```

---

## 🚀 Running & Development

### **Development Server**

#### Terminal 1 - API Server (Laravel)

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

#### Terminal 2 - Asset Bundler (Vite)

```bash
npm run dev
```

Vite akan watch untuk perubahan file dan auto-reload browser

### **Production Build**

```bash
npm run build
```

Assets akan di-compile ke folder `public/build/`

### **Running Tests**

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ProductTest.php

# Run with coverage
php artisan test --coverage
```

---

## 🗄️ Konfigurasi Environment

### **Konfigurasi Database**

Pastikan database sudah dibuat di MySQL:

```sql
CREATE DATABASE proyek2_toko_bunga_wilis CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau gunakan phpMyAdmin untuk membuat database.

### **Konfigurasi Google OAuth**

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Create project baru
3. Enable Google+ API
4. Create OAuth 2.0 credentials (Web application)
5. Set Authorized redirect URI: `http://localhost:8000/auth/google/callback`
6. Copy Client ID dan Client Secret ke `.env`

### **Konfigurasi Midtrans Payment**

1. Buka [Midtrans Dashboard](https://dashboard.midtrans.com/)
2. Sign up untuk sandbox account
3. Ambil Merchant ID, Client Key, dan Server Key
4. Copy ke `.env` dengan `MIDTRANS_IS_PRODUCTION=false` untuk sandbox mode

### **Konfigurasi Email (Opsional)**

Untuk email verification dan notifications, gunakan:

- **Mailtrap.io** (testing email dalam development)
- **Gmail SMTP** (production)
- **Sendgrid** (production)

---

## 📊 Database Schema

### **Tabel Utama**

#### **Users**

```
- id (PK)
- name
- email (UNIQUE)
- password (hashed)
- profile_photo (URL)
- phone
- google_id (for OAuth)
- email_verified_at
- role (user/admin)
- timestamps
```

#### **Kategori (Categories)**

```
- id (PK)
- nama
- deskripsi
- slug
- timestamps
```

#### **Produk (Products)**

```
- id (PK)
- kategori_id (FK)
- nama
- slug
- deskripsi
- harga_dasar
- stock
- foto_utama
- petunjuk_perawatan
- status (active/inactive)
- timestamps
```

#### **Ukuran (Sizes)**

```
- id (PK)
- produk_id (FK)
- nama_ukuran (small/medium/large)
- harga_tambahan
- stock_ukuran
- timestamps
```

#### **Pesanan (Orders)**

```
- id (PK)
- user_id (FK)
- no_pesanan (UNIQUE)
- total_harga
- status (pending/paid/shipped/delivered)
- metode_pembayaran
- alamat_pengiriman
- nama_penerima
- nomor_telepon
- catatan
- tanggal_pembayaran
- timestamps
```

#### **Pesanan Item (Order Items)**

```
- id (PK)
- pesanan_id (FK)
- produk_id (FK)
- ukuran_id (FK)
- quantity
- harga_satuan
- subtotal
```

#### **Review (Reviews/Ratings)**

```
- id (PK)
- user_id (FK)
- produk_id (FK)
- pesanan_item_id (FK)
- rating (1-5)
- judul
- komentar
- foto_review
- status (pending/approved/rejected)
- timestamps
```

#### **Notifikasi (Notifications)**

```
- id (PK)
- user_id (FK)
- pesanan_id (FK)
- tipe (order_created/payment_confirmed/shipped)
- pesan
- is_read
- timestamps
```

---

## 🖼️ Preview Aplikasi

Aplikasi ini **belum di-deploy ke hosting**, sehingga preview tampilan website disediakan dalam bentuk **screenshot**.

### 📁 Screenshot Dokumentasi

Semua screenshot UI aplikasi tersedia di folder **`docs/`** dengan dokumentasi visual lengkap meliputi:

- 🔐 **Autentikasi**: Login, Registrasi, Forgot Password
- 🏠 **Homepage**: Landing page dengan featured products & testimonials
- 📦 **Products**: Daftar produk, filter kategori, search
- 🔍 **Detail Produk**: Foto gallery, deskripsi, ukuran, harga, review
- 🛒 **Keranjang**: View cart, update quantity, total price
- 💳 **Checkout**: Alamat pengiriman, metode pembayaran
- 💰 **Pembayaran**: Midtrans payment gateway simulation
- 👤 **Profil**: Data pengguna, foto profil, alamat pengiriman
- 📋 **Riwayat Pesanan**: Track order status
- ⭐ **Review**: Rating dan ulasan produk
- 🔔 **Notifikasi**: Order notifications
- 📊 **Admin Dashboard**: Statistics dan overview
- ⚙️ **Admin Panels**: Product, Order, Review, User management

Silakan buka folder `docs/` untuk melihat preview lengkap.

### Alur Penggunaan (User Journey)

```
1. Registrasi / Login
   ↓
2. Browse Produk (dengan filter & search)
   ↓
3. Lihat Detail Produk (foto, deskripsi, review)
   ↓
4. Tambah ke Keranjang (pilih ukuran & quantity)
   ↓
5. Review Keranjang (update quantity/hapus)
   ↓
6. Checkout (isi alamat & metode pengiriman)
   ↓
7. Simulasi Pembayaran (Midtrans)
   ↓
8. Konfirmasi Pesanan
   ↓
9. Track Order Status
   ↓
10. Buat Review (setelah produk diterima)
```

---

## 📖 Panduan Penggunaan

### **Sebagai User Biasa**

1. **Registrasi Akun**
    - Klik tombol "Sign Up"
    - Isi form dengan email, password
    - Atau login dengan Google
    - Verifikasi email (jika diperlukan)

2. **Browsing Produk**
    - Lihat daftar produk di homepage
    - Gunakan filter kategori atau search bar
    - Klik produk untuk melihat detail

3. **Belanja**
    - Di halaman detail produk, pilih ukuran dan quantity
    - Klik "Tambah ke Keranjang"
    - Bisa lanjut belanja atau checkout

4. **Checkout & Pembayaran**
    - Buka keranjang, review produk
    - Klik "Checkout"
    - Isi form pemesanan (nama, alamat, telepon)
    - Pilih metode pembayaran
    - Simulasi pembayaran di Midtrans

5. **Track Pesanan**
    - Buka "Riwayat Pesanan" di profil
    - Lihat status update pesanan
    - Lihat detail pesanan

6. **Buat Review**
    - Setelah pesanan selesai, klik "Buat Review"
    - Isi rating dan komentar
    - Submit review

### **Sebagai Admin**

1. **Login Admin**
    - Akses dashboard admin di `/admin`
    - Login dengan akun admin

2. **Dashboard**
    - Lihat overview statistik penjualan
    - Monitor notifikasi pesanan masuk

3. **Manajemen Produk**
    - Navigasi ke Menu Produk
    - Tambah produk baru (+ Add Product)
    - Edit spesifikasi, harga, foto
    - Kelola ukuran dan stok

4. **Manajemen Pesanan**
    - Lihat daftar pesanan
    - Update status pesanan
    - Lihat detail pesanan & customer info

5. **Manajemen Review**
    - Monitor review & rating produk
    - Hapus review yang tidak sesuai
    - Highlight review terbaik

6. **Manajemen User**
    - Lihat daftar user/pelanggan
    - Monitor aktivitas

---

## 🔑 Akun Demo

### **Midtrans Payment Testing**

Mode: **Sandbox** (untuk simulasi pembayaran)

Nomor kartu kredit testing:

- **Visa**: 4811 1111 1111 1114
- **Mastercard**: 5555 5555 5555 4444
- **Debit Mandiri**: 9360 0000 0000 9999

CVV: 123 (atau angka apapun)
Expired Date: Bulan/Tahun mendatang

**Catatan**: Akun user dan admin dapat dibuat melalui proses registrasi atau seeding saat setup awal dengan menjalankan `php artisan migrate --seed`

---

## ⚠️ Troubleshooting

### **Issue: "php artisan key:generate" Error**

```bash
# Solusi:
php artisan key:generate
# Atau manual di .env
APP_KEY=base64:generate_key_here
```

### **Issue: Composer Install Gagal**

```bash
# Solusi:
composer update --no-dev
# atau
composer install --no-dev
```

### **Issue: npm install Gagal**

```bash
# Bersihkan cache npm
npm cache clean --force

# Atau gunakan yarn
yarn install
```

### **Issue: Database Connection Error**

- ✅ Verifikasi MySQL berjalan: `mysql -u root`
- ✅ Cek DB credentials di `.env`
- ✅ Create database: `CREATE DATABASE proyek2_toko_bunga_wilis;`
- ✅ Run migration: `php artisan migrate`

### **Issue: Vite/Assets tidak loading**

```bash
# Build ulang assets
npm run build

# atau development mode
npm run dev
```

### **Issue: Login Google Tidak Bekerja**

- ✅ Verifikasi Google OAuth keys di `.env`
- ✅ Pastikan redirect URI sesuai di Google Cloud Console
- ✅ Restart development server

### **Issue: Midtrans Payment Error**

- ✅ Verifikasi Midtrans keys di `.env` is correct
- ✅ Pastikan `MIDTRANS_IS_PRODUCTION=false` untuk sandbox
- ✅ Cek Midtrans dashboard untuk error logs

### **Issue: Migration Error**

```bash
# Rollback semua migrations
php artisan migrate:reset

# atau rollback 1 step
php artisan migrate:rollback

# Jalankan ulang
php artisan migrate:fresh --seed
```

---

## 📝 Catatan Pengembang

### **Development Notes**

- Aplikasi ini menggunakan **Laravel 11** dengan PHP 8.3
- Frontend menggunakan **Bootstrap 5** + **Vite bundler**
- Database menggunakan **MySQL** dengan Eloquent ORM
- Payment gateway menggunakan **Midtrans Sandbox**
- Authentication menggunakan **Laravel Breeze** + **Socialite** (Google OAuth)

### **Best Practices yang Diterapkan**

- ✅ MVC Architecture dengan clear separation of concerns
- ✅ Form Request Validation untuk server-side validation
- ✅ Eloquent ORM dengan relationship mapping
- ✅ Middleware untuk authentication & authorization
- ✅ Service classes untuk business logic (MidtransService)
- ✅ Blade templating dengan reusable components
- ✅ CSS-in-JS dengan SCSS preprocessing
- ✅ Responsive design dari mobile-first approach

### **Folder yang Dapat Dikustomisasi**

- `resources/views/` - Blade templates
- `resources/scss/` - Stylesheets
- `resources/js/` - JavaScript files
- `public/images/` - Static images

### **Database Management**

- Gunakan **phpMyAdmin** di Laragon/XAMPP untuk manage database melalui web interface
- Akses di: `http://localhost/phpmyadmin` (Laragon) atau `http://localhost/phpmyadmin` (XAMPP)
- Atau gunakan MySQL Workbench untuk database client desktop
- Untuk query langsung di terminal Laravel: `php artisan tinker`

### **Debugging**

- Enable debug mode di `.env`: `APP_DEBUG=true`
- Cek logs di `storage/logs/laravel.log`
- Gunakan `dd()` atau `dump()` untuk debugging
- Gunakan Laravel Debugbar untuk profiling

---

## 📄 Lisensi

![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)
![License](https://img.shields.io/github/license/TinoNurcahya/proyek2-toko-bunga-wilis)

Proyek ini adalah **proyek akademik/pembelajaran** yang dibuat untuk keperluan **Proyek Akhir Semester (Proyek 2)**.

**Lisensi**: [MIT License](LICENSE) - Anda bebas menggunakan, memodifikasi, dan mendistribusikan kode ini dengan melampirkan notice lisensi asli.

### Ketentuan Penggunaan:

- ✅ Diizinkan untuk penggunaan **pribadi**
- ✅ Diizinkan untuk **memodifikasi**
- ⚠️ **Harus** menyertakan `LICENSE` file asli
- ⚠️ **Tidak ada garansi** - gunakan atas risiko Anda sendiri

---

## 👨‍💼 Tim Pengembang

Proyek ini dikembangkan secara **kolaboratif** oleh tim yang solid dengan kontribusi setara dari setiap anggota.

### **Tim Pengembang**

| Name                | GitHub                                                           |
| ------------------- | ---------------------------------------------------------------- |
| Tino Nurcahya       | [@TinoNurcahya](https://github.com/TinoNurcahya)                 |
| Ghinaa Aulia Zahro | [@auliaghinaa75-bit](https://github.com/auliaghinaa75-bit)       |
| Viola Insan Putri   | [@violainsanputri-prog](https://github.com/violainsanputri-prog) |
| Andika Dwiki Muhammad     | [@dikarajadirot](https://github.com/dikarajadirot)               |

Semua anggota tim berkontribusi dalam perencanaan, pengembangan, testing, dan deployment proyek ini dengan komitmen penuh.

---


## 🙏 Terima Kasih & Kontribusi

Terima kasih telah menggunakan **Toko Bunga Wilis**! 🌸

### 💖 Dukungan Anda

Jika project ini bermanfaat untuk Anda:

- ⭐ **Berikan Star** di GitHub - Sangat membantu meningkatkan visibility project
- 🔗 **Share** project ini ke teman-teman atau komunitas
- 💬 **Feedback** - Beri saran atau laporan bug melalui GitHub Issues
- 🤝 **Kontribusi** - Buat pull request untuk improvement

### 📚 Sumber & Referensi

Proyek ini menggunakan berbagai library dan framework open-source:

- [Laravel](https://laravel.com) - Web Framework
- [Bootstrap](https://getbootstrap.com) - CSS Framework
- [Midtrans](https://midtrans.com) - Payment Gateway
- [Socialite](https://laravel.com/docs/socialite) - Social Authentication

---

<div align="center">

🌸 **Dibuat dengan ❤️ oleh [Tim Toko Bunga Wilis](#-tim-pengembang)** 🌸

**[⬆ Kembali ke atas](#-toko-bunga-wilis)**

</div>
