<?php 
include 'db.php';
if(!isset($_SESSION['user'])) header("Location: index.php");
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="en">
<head>
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="root">
        <div class="card" style="width: 30rem; padding: 25px;">
            <h3>Edit Profil</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="nama" class="form-control mb-2" value="<?php echo $user['nama']; ?>">
                <input type="text" name="jurusan" class="form-control mb-2" value="<?php echo $user['jurusan']; ?>">
                <label>Ganti Foto ID Card:</label>
                <input type="file" name="foto" class="form-control mb-3">
                <button name="update" class="btn btn-success w-100 text-white">Simpan</button>
                <a href="index.php" class="btn btn-light w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['update'])){
    $nama = $_POST['nama']; $jurusan = $_POST['jurusan'];
    $nim = $user['nim'];
    if($_FILES['foto']['name']){
        $filename = time().'_'.$_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$filename);
        mysqli_query($conn, "UPDATE users SET nama='$nama', jurusan='$jurusan', foto_path='$filename' WHERE nim='$nim'");
    } else {
        mysqli_query($conn, "UPDATE users SET nama='$nama', jurusan='$jurusan' WHERE nim='$nim'");
    }
    // Update session
    $res = mysqli_query($conn, "SELECT * FROM users WHERE nim='$nim'");
    $_SESSION['user'] = mysqli_fetch_assoc($res);
    echo "<script>alert('Update Berhasil!'); window.location='index.php';</script>";
}
?>