<?php
$host = "localhost";
$user = "root";
$pass = ""; // password default XAMPP
$dbname = "db_barang"; // pastikan database ini sudah dibuat

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
