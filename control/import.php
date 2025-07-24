<?php
require __DIR__ . '/../vendor/autoload.php';
include '../config/db.php';
session_start();

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['excel_file']['tmp_name'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    $duplikat = [];
    $insertedCount = 0;
    $tanpaBahan = [];

    for ($i = 1; $i < count($data); $i++) {
        $kodeBarang = trim($data[$i][0]);
        $namaBarang = trim($data[$i][1]);
        $kategori   = trim($data[$i][2]);
        $kodeBahan  = trim($data[$i][3]);
        $namaBahan  = trim($data[$i][4]);

        if ($kodeBarang == "") continue;

        if ($kodeBahan == "") {
            $tanpaBahan[] = "$kodeBarang - $namaBarang";
            continue;
        }

        $cek = $conn->prepare("SELECT id FROM barang WHERE kode_barang = ?");
        $cek->bind_param("s", $kodeBarang);
        $cek->execute();
        $cek->bind_result($idBarang);
        $exists = $cek->fetch();
        $cek->close();

        if (!$exists) {
            $stmt = $conn->prepare("INSERT INTO barang (kode_barang, nama_barang, kategori) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $kodeBarang, $namaBarang, $kategori);
            $stmt->execute();
            $idBarang = $stmt->insert_id;
            $stmt->close();
            $insertedCount++;
        } else {
            $duplikat[] = "$kodeBarang - $namaBarang";
        }

        $cekBahan = $conn->prepare("SELECT COUNT(*) FROM bahan_baku WHERE kode_bahan = ? AND id_barang = ?");
        $cekBahan->bind_param("si", $kodeBahan, $idBarang);
        $cekBahan->execute();
        $cekBahan->bind_result($jumlahBahan);
        $cekBahan->fetch();
        $cekBahan->close();

        if ($jumlahBahan == 0) {
            $stmtBahan = $conn->prepare("INSERT INTO bahan_baku (kode_bahan, nama_bahan, id_barang) VALUES (?, ?, ?)");
            $stmtBahan->bind_param("ssi", $kodeBahan, $namaBahan, $idBarang);
            $stmtBahan->execute();
            $stmtBahan->close();
        }
    }

    $_SESSION['alerts'] = [];

    if ($insertedCount > 0) {
        $_SESSION['alerts'][] = ['type' => 'success', 'message' => "Import berhasil. Barang baru: $insertedCount."];
    }

    if (!empty($tanpaBahan)) {
        $_SESSION['alerts'][] = ['type' => 'danger', 'message' => "Barang berikut tidak diimpor karena tidak memiliki bahan: " . implode(", ", $tanpaBahan)];
    }

    if ($insertedCount === 0 && !empty($duplikat)) {
        $_SESSION['alerts'][] = ['type' => 'danger', 'message' => "Semua data sudah ada, tidak ada yang dimasukkan. Duplikat: " . implode(", ", $duplikat)];
    } elseif (!empty($duplikat)) {
        $_SESSION['alerts'][] = ['type' => 'warning', 'message' => "Sebagian data tidak dimasukkan karena kode duplikat: " . implode(", ", $duplikat)];
    }


    header('Location: ../index.php');
    exit;
}
