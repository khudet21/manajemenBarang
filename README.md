# 📦 Manajemen Barang

**Manajemen Barang** adalah aplikasi manajemen inventaris berbasis **PHP Native** dan **MySQL**, yang dirancang untuk memudahkan pengelolaan data barang dan bahan baku dalam suatu organisasi atau perusahaan. Aplikasi ini dilengkapi dengan antarmuka interaktif berbasis **Bootstrap**, fitur tambah/edit/hapus, serta sistem import data dari file Excel.

## ✨ Fitur Unggulan

- ✅ Tambah, edit, dan hapus data barang & bahan baku  
- 📊 Tabel interaktif dengan Bootstrap  
- 📁 Import data dari file Excel  
- 🔍 Tampilan detail bahan baku yang rapi dan dapat dikolaps  
- 🧱 Struktur kode modular (menggunakan folder `views/` untuk layout)

## 🛠️ Teknologi yang Digunakan

- **Bahasa Pemrograman:** PHP Native  
- **Database:** MySQL  
- **Frontend:** Bootstrap 5  
- **Library Eksternal:** PHPSpreadsheet (untuk import Excel)

## 📁 Struktur Direktori

manajemenBarang/
├── config/
│ └── db.php # Koneksi database
│
├── control/ # Logic proses
│ ├── add.php # Tambah barang
│ ├── create.php # Simpan ke database
│ ├── delete.php # Hapus barang
│ └── import.php # Proses import Excel
│
├── vendor/ # Dependency Composer (PHPSpreadsheet)
│
├── views/ # Tampilan halaman
│ ├── footer.php
│ ├── form.php
│ └── header.php
│
├── db_barang.sql # File SQL untuk struktur dan data awal
├── index.php # Halaman utama (daftar barang)
├── composer.json # File konfigurasi Composer
├── composer.lock
├── .gitignore
└── README.md # Dokumentasi proyek ini


## ⚙️ Instalasi & Konfigurasi

### 1. Clone repo ini

```bash
git clone https://github.com/username/manajemenBarang.git
cd manajemenBarang

### 2. Install dependency PHPSpreadsheet (jika vendor/ belum ada)

```bash
composer require phpoffice/phpspreadsheet

### 3. Import database MySQL

db_barang.sql

### 4. Edit konfigurasi database di config/db.php

$conn = new mysqli("localhost", "root", "", "nama_database");

### 5. Jalankan aplikasi via browser

http://localhost/manajemenBarang/index.php