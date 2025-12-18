<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "idcard"; // Nama database diperbarui

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database 'idcard' gagal: " . mysqli_connect_error());
}

session_start();
?>