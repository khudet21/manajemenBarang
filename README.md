📦 Manajemen Barang
Manajemen Barang adalah aplikasi manajemen inventaris berbasis PHP Native dan MySQL, yang dirancang untuk memudahkan pengelolaan data barang dan bahan baku dalam suatu organisasi atau perusahaan. Aplikasi ini dilengkapi dengan antarmuka interaktif berbasis Bootstrap, fitur tambah/edit/hapus, serta sistem import data dari file Excel.

🚀 Fitur Unggulan
✅ Tambah, edit, dan hapus data barang & bahan baku
📊 Tabel interaktif dengan Bootstrap
📁 Import data dari file Excel
🔍 Tampilan detail bahan baku yang rapi dan dapat dikolaps
📂 Struktur kode modular (menggunakan folder views/ untuk layout)

🛠️ Teknologi yang Digunakan
Bahasa Pemrograman: PHP Native
Database: MySQL
Frontend: Bootstrap 5
Library Eksternal: PHPSpreadsheet (untuk import Excel)

🗂️ Struktur Direktori
manajemenBarang/
├── config/
│   └── db.php               # Koneksi database
│
├── control/                # Logic proses
│   ├── add.php             # Tambah barang
│   ├── create.php          # Simpan ke database
│   ├── delete.php          # Hapus barang
│   └── import.php          # Proses import Excel
│
├── vendor/                 # Dependency Composer (PHPSpreadsheet)
│   └── ...                 
│
├── views/                  # Tampilan halaman
│   ├── footer.php
│   ├── form.php
│   └── header.php
│
├── db_barang.sql           # File SQL untuk struktur dan data awal
├── index.php               # Halaman utama (daftar barang)
├── composer.json           # File konfigurasi Composer
├── composer.lock
├── .gitignore
└── README.md               # Dokumentasi proyek ini

📦 Instalasi & Konfigurasi
Clone repo ini:

git clone https://github.com/username/manajemenBarang.git
cd manajemenBarang
Install dependency PHPSpreadsheet (jika vendor/ belum ada):

composer require phpoffice/phpspreadsheet
Import database MySQL:

Gunakan phpMyAdmin atau CLI

Import file db_barang.sql

Edit config/db.php sesuai dengan database lokal kamu:

$conn = new mysqli("localhost", "root", "", "nama_database");
Akses via browser:

http://localhost/manajemenBarang/index.php

📥 Cara Import Excel
Siapkan file Excel dengan format kolom sesuai kebutuhan (misalnya: nama_barang, jumlah, satuan, dll)

Klik tombol "Import Excel" di halaman utama

Pilih file, lalu klik "Upload"

Data akan otomatis dimasukkan ke dalam database jika format sesuai.

📌 Catatan Tambahan
Pastikan ekstensi php_zip, php_xml, dan php_mbstring aktif untuk menggunakan PHPSpreadsheet

Untuk menambahkan validasi atau fitur pencarian/filter, Anda bisa mengembangkan modul JavaScript tambahan

📧 Kontak
Untuk pertanyaan atau saran pengembangan lebih lanjut, silakan hubungi:

Nama: Samsul Huda
Email: huddd2106@gmail.com  
GitHub: https://github.com/khudet21