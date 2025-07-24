<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus bahan baku terlebih dahulu (foreign key)
    $stmt_bahan = $conn->prepare("DELETE FROM bahan_baku WHERE id_barang = ?");
    $stmt_bahan->bind_param("i", $id);
    $stmt_bahan->execute();

    // Hapus barang
    $stmt_barang = $conn->prepare("DELETE FROM barang WHERE id = ?");
    $stmt_barang->bind_param("i", $id);
    $stmt_barang->execute();
}

header("Location: ../index.php");
exit;
