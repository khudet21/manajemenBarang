<?php
session_start();
include '../config/db.php';

$id         = isset($_GET['id']) ? intval($_GET['id']) : null;
$isEdit     = $id ? true : false;
$kode       = trim($_POST['kode']);
$nama       = trim($_POST['nama']);
$kategori   = trim($_POST['kategori']);
$kode_bahan = $_POST['kode_bahan'] ?? [];
$nama_bahan = $_POST['nama_bahan'] ?? [];

if (empty($kode) || empty($nama) || empty($kategori)) {
    $_SESSION['error'] = "Kode, Nama, dan Kategori wajib diisi.";
    header("Location: add.php" . ($isEdit ? "?id=$id" : ""));
    exit;
}

$duplikat = false;
$duplikatPesan = "";

$kode_cek = [];
$nama_cek = [];
foreach ($kode_bahan as $i => $kb) {
    $kode_trim = trim($kb);
    $nama_trim = trim($nama_bahan[$i]);

    if (in_array($kode_trim, $kode_cek)) {
        $duplikat = true;
        $duplikatPesan = "Kode Bahan '$kode_trim' duplikat.";
        break;
    }
    if (in_array($nama_trim, $nama_cek)) {
        $duplikat = true;
        $duplikatPesan = "Nama Bahan '$nama_trim' duplikat.";
        break;
    }

    $kode_cek[] = $kode_trim;
    $nama_cek[] = $nama_trim;
}

if ($duplikat) {
    $_SESSION['error'] = $duplikatPesan;
    header("Location: add.php" . ($isEdit ? "?id=$id" : ""));
    exit;
}

if ($isEdit) {
    $stmt_cek = $conn->prepare("SELECT COUNT(*) FROM barang WHERE kode_barang = ? AND id != ?");
    $stmt_cek->bind_param("si", $kode, $id);
    $stmt_cek->execute();
    $stmt_cek->bind_result($jumlah);
    $stmt_cek->fetch();
    $stmt_cek->close();

    if ($jumlah > 0) {
        $_SESSION['error'] = "Kode Barang '$kode' sudah digunakan oleh barang lain.";
        header("Location: add.php?id=$id");
        exit;
    }
}

if ($isEdit) {
    $stmt_barang = $conn->prepare("UPDATE barang SET kode_barang = ?, nama_barang = ?, kategori = ? WHERE id = ?");
    $stmt_barang->bind_param("sssi", $kode, $nama, $kategori, $id);
    $stmt_barang->execute();

    $stmt_delete = $conn->prepare("DELETE FROM bahan_baku WHERE id_barang = ?");
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();

    $stmt_bahan = $conn->prepare("INSERT INTO bahan_baku (id_barang, kode_bahan, nama_bahan) VALUES (?, ?, ?)");
    foreach ($kode_bahan as $i => $kb) {
        $stmt_bahan->bind_param("iss", $id, $kode_bahan[$i], $nama_bahan[$i]);
        $stmt_bahan->execute();
    }
} else {
    $stmt_cek = $conn->prepare("SELECT COUNT(*) FROM barang WHERE kode_barang = ?");
    $stmt_cek->bind_param("s", $kode);
    $stmt_cek->execute();
    $stmt_cek->bind_result($jumlah);
    $stmt_cek->fetch();
    $stmt_cek->close();

    if ($jumlah > 0) {
        $_SESSION['error'] = "Kode Barang '$kode' sudah ada.";
        header("Location: add.php");
        exit;
    }

    $stmt_insert = $conn->prepare("INSERT INTO barang (kode_barang, nama_barang, kategori) VALUES (?, ?, ?)");
    $stmt_insert->bind_param("sss", $kode, $nama, $kategori);
    $stmt_insert->execute();

    $id_barang = $stmt_insert->insert_id ?: mysqli_insert_id($conn); // jaga-jaga

    $stmt_bahan = $conn->prepare("INSERT INTO bahan_baku (id_barang, kode_bahan, nama_bahan) VALUES (?, ?, ?)");
    foreach ($kode_bahan as $i => $kb) {
        $stmt_bahan->bind_param("iss", $id_barang, $kode_bahan[$i], $nama_bahan[$i]);
        $stmt_bahan->execute();
    }
}

header("Location: ../index.php");
exit;
