-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2025 pada 21.33
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_bahan` varchar(10) DEFAULT NULL,
  `nama_bahan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `id_barang`, `kode_bahan`, `nama_bahan`) VALUES
(898, 734, 'B001', 'Kayu Jati'),
(899, 734, 'B002', 'Paku Baja'),
(900, 735, 'B003', 'Plastik ABS'),
(901, 735, 'B004', 'Engsel Kecil'),
(902, 736, 'B005', 'Motor DC'),
(903, 736, 'B006', 'Mata Bor Baja'),
(904, 737, 'B007', 'Besi Karbon'),
(905, 738, 'B008', 'Baja Tahan Karat'),
(906, 739, 'B009', 'Ijuk'),
(907, 739, 'B010', 'Pegangan Kayu'),
(908, 740, 'B011', 'Kepala Besi'),
(909, 740, 'B012', 'Gagang Kayu'),
(910, 741, 'B013', 'Burner'),
(911, 741, 'B014', 'Regulator'),
(912, 742, 'B015', 'Aluminium'),
(913, 743, 'B016', 'Stainless Steel'),
(914, 744, 'B017', 'Motherboard'),
(915, 744, 'B018', 'LCD Panel'),
(916, 745, 'B019', 'Cartridge'),
(917, 745, 'B020', 'Motor Stepper'),
(919, 747, 'B023', 'Kayu Mahoni'),
(920, 748, 'B026', 'Kayu MDF'),
(922, 747, 'B024', 'Kayu Mahoni'),
(924, 747, 'B029', 'Kayu Jatii'),
(927, 746, 'B021', 'Dinamo'),
(928, 746, 'B025', 'Dinamo3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `kategori`) VALUES
(734, 'BRG001', 'Meja Kayu', 'Furniture'),
(735, 'BRG002', 'Lemari Plastik', 'Furniture'),
(736, 'BRG003', 'Bor Tangan', 'Perkakas'),
(737, 'BRG004', 'Tang Kombinasi', 'Perkakas'),
(738, 'BRG005', 'Obeng Plus', 'Perkakas'),
(739, 'BRG006', 'Sapu Ijuk', 'Peralatan'),
(740, 'BRG007', 'Palu Besi', 'Perkakas'),
(741, 'BRG008', 'Kompor Gas', 'Elektronik'),
(742, 'BRG009', 'Wajan', 'Dapur'),
(743, 'BRG010', 'Panci Stainless', 'Dapur'),
(744, 'BRG011', 'Laptop', 'Elektronik'),
(745, 'BRG012', 'Printer Inkjet', 'Elektronik'),
(746, 'BRG013', 'Kipas Angin', 'Elektronik'),
(747, 'BRG014', 'Lemari Kayu', 'Furniture'),
(748, 'BRG016', 'Meja Belajar', 'Furniture');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=929;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=749;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD CONSTRAINT `bahan_baku_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
