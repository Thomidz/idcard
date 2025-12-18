<?php 
include 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
$nim_user = $user['nim'];

// Proses Update Profil Utama
if(isset($_POST['update'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    
    if(!empty($_FILES['foto']['name'])){
        $filename = time().'_'.$_FILES['foto']['name'];
        if(move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$filename)){
            $sql = "UPDATE users SET nama='$nama', jurusan='$jurusan', foto_path='$filename' WHERE nim='$nim_user'";
        }
    } else {
        $sql = "UPDATE users SET nama='$nama', jurusan='$jurusan' WHERE nim='$nim_user'";
    }

    if(mysqli_query($conn, $sql)){
        $res = mysqli_query($conn, "SELECT * FROM users WHERE nim='$nim_user'");
        $_SESSION['user'] = mysqli_fetch_assoc($res);
        echo "<script>alert('Profil diperbarui!'); window.location='profile.php';</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profil & Riwayat ID Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; }
        .main-container { max-width: 800px; margin: 50px auto; }
        .history-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<div class="container main-container">
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4">Pengaturan Profil</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="<?= $user['jurusan'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Foto Profil Utama</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <button name="update" class="btn btn-success w-100">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Home</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4"><i class="bi bi-clock-history"></i> Riwayat ID Card</h4>
                    <div class="overflow-auto" style="max-height: 500px;">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM history_idcard WHERE user_nim = '$nim_user' ORDER BY created_at DESC");
                        if(mysqli_num_rows($query) > 0):
                            while($row = mysqli_fetch_assoc($query)): ?>
                                <div class="d-flex align-items-center p-3 mb-2 border rounded bg-white">
                                    <img src="<?= $row['foto_kartu'] ?>" class="history-img me-3 border">
                                    <div>
                                        <div class="fw-bold"><?= htmlspecialchars($row['nama_kartu']) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($row['jurusan_kartu']) ?></div>
                                        <div class="text-muted" style="font-size: 0.7rem;"><?= $row['created_at'] ?></div>
                                    </div>
                                </div>
                            <?php endwhile; 
                        else: ?>
                            <p class="text-center text-muted">Belum ada riwayat pembuatan kartu.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>