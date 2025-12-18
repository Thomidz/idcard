<?php
include 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    die("Unauthorized");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim_user = $_SESSION['user']['nim'];
    $nama_kartu = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan_kartu = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $foto_kartu = $_POST['foto']; 

    $query = "INSERT INTO history_idcard (user_nim, nama_kartu, jurusan_kartu, foto_kartu) 
              VALUES ('$nim_user', '$nama_kartu', '$jurusan_kartu', '$foto_kartu')";

    if (mysqli_query($conn, $query)) {
        echo "Berhasil";
    } else {
        header('HTTP/1.1 500 Internal Server Error');
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>