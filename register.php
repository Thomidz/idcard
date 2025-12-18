<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <title>Daftar - ID CARD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="root">
        <div class="card" style="width: 30rem; padding: 25px;">
            <h3 class="text-center">BUAT AKUN</h3>
            <form method="POST">
                <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
                <div class="mb-3"><label>NIM</label><input type="text" name="nim" class="form-control" required></div>
                <div class="mb-3"><label>Jurusan</label><input type="text" name="jurusan" class="form-control" required></div>
                <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <button name="register" class="btn btn-primary w-100 text-white">DAFTAR</button>
            </form>
            <p class="text-center mt-3">Sudah punya akun? <a href="index.php">Login</a></p>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['register'])){
    $nama = $_POST['nama']; $nim = $_POST['nim']; $jurusan = $_POST['jurusan'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO users (nama, nim, jurusan, password) VALUES ('$nama', '$nim', '$jurusan', '$pass')";
    if(mysqli_query($conn, $query)){
        echo "<script>alert('Berhasil Daftar!'); window.location='index.php';</script>";
    }
}
?>