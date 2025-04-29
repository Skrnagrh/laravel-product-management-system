# Laravel Product Management System

Aplikasi **Product Management System** lengkap berbasis **Laravel**. Aplikasi ini mencakup fitur autentikasi, operasi CRUD, upload file, audit trail, serta ekspor dan impor file Excel. Dirancang untuk mengelola **Kategori**, **Supplier**, **Produk**, dan **Pengguna** secara efisien.

## Fitur

- **Autentikasi**
  - Landing Page Publik
  - Dashboard yang hanya bisa diakses pengguna yang sudah login
  - CRUD untuk Manajemen Role
  - CRUD untuk Akun Pengguna (khusus Administrator)

- **Manajemen Produk (CRUD)**
  - CRUD Kategori
  - CRUD Supplier
  - CRUD Produk
  - CRUD Pengguna

- **Pengelolaan Data Lanjutan**
  - Menggunakan UUID sebagai primary key
  - Field DateTime untuk pencatatan waktu
  - Field Boolean
  - Field JSON untuk data fleksibel
  - Relasi antar entitas

- **Fitur Tambahan**
  - Soft Deletes di semua entitas
  - Upload file (hanya PDF, ukuran 100-500 KB)
  - Integrasi Select2 untuk dropdown dinamis
  - Fitur pencarian, penyaringan, dan pengurutan data

- **Audit Trail**
  - Pencatatan penuh untuk operasi create, update, dan delete
  - Model Auditable untuk menjaga histori data meskipun data induk berubah

- **Ekspor dan Impor Excel**
  - Ekspor dan impor data untuk semua entitas
  - Dynamic field mapping saat proses ekspor/impor
  - Proses berjalan di background menggunakan Queue

## Teknologi yang Digunakan

- Laravel 12
- SQLlite
- Bootstrap
- Select2
- Laravel Queue (Redis / Database)
- Laravel Auditing Package
- Laravel Excel

## Instalasi

```bash
# Clone repository
git clone https://github.com/your-username/laravel-product-management-system.git

# Masuk ke folder project
cd laravel-product-management-system

# Install semua dependency
composer install

# Salin dan atur file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Setup database
php artisan migrate --seed

# Jalankan server
php artisan serve
```

## Cara Menggunakan

- Akses `http://localhost:8000/` untuk landing page publik.
- Login untuk mengakses dashboard dan mengelola role, user, kategori, supplier, dan produk.

## Kontribusi

Silakan fork project ini, lakukan perbaikan, dan kirimkan pull request! Kontribusi dari siapa pun sangat dihargai.

## Pratinjau

| <img src="/public/tampilan/1.jpeg" alt="Desktop" width="100%"> | <img src="/public/tampilan/2.jpeg" alt="Pad" width="100%"> |
| :-------------------------------------------------------------: | :---------------------------------------------------------: |
|                        Home Page                         |                        Login Page                         |

| <img src="/public/tampilan/3.jpeg" alt="Full" width="100%"> | <img src="/public/tampilan/4.jpeg" alt="Full" width="100%"> |
| :----------------------------------------------------------: | :----------------------------------------------------------: |
|                   Dashboard Page                   |                   Category Page                    |
| <img src="/public/tampilan/5.jpeg" alt="Desktop" width="100%"> | <img src="/public/tampilan/6.jpeg" alt="Pad" width="100%"> |
| :-------------------------------------------------------------: | :---------------------------------------------------------: |
|                        Supplier Page                         |                        Product Page                         |

| <img src="/public/tampilan/7.jpeg" alt="Full" width="100%"> | <img src="/public/tampilan/8.jpeg" alt="Full" width="100%"> |
| :----------------------------------------------------------: | :----------------------------------------------------------: |
|                   Audit-Trail Product Page                   |                   User Page                    |
