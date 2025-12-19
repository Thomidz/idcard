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
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='profile.php';</script>";
    }
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Profil & Riwayat ID Card</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profilestyle.css">
</head>

<body>

<!-- HEADER -->
<div class="page-header text-center">
    <h2 class="fw-bold mb-1">Profil Pengguna</h2>
    <p class="mb-0">Kelola akun & riwayat ID Card Anda</p>
</div>

<div class="container mb-5">
    <div class="row g-4">

        <!-- PROFIL -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <h5 class="fw-bold mb-0"><?= htmlspecialchars($user['nama']) ?></h5>
                    <small class="text-muted"><?= htmlspecialchars($user['nim']) ?></small>

                    <hr>

                    <form method="POST" enctype="multipart/form-data" class="text-start">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($user['jurusan']) ?>" required>
                        </div>


                        <button name="update" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>

                        <a href="home.php" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </form>

                </div>
            </div>
        </div>

        <!-- RIWAYAT -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-clock-history text-success"></i> Riwayat Pembuatan ID Card
                    </h5>

                    <div class="overflow-auto" style="max-height: 500px;">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM history_idcard WHERE user_nim = '$nim_user' ORDER BY created_at DESC");
                        if(mysqli_num_rows($query) > 0):
                            while($row = mysqli_fetch_assoc($query)): ?>
                                <div class="d-flex align-items-center p-3 mb-3 border rounded history-item">
                                    <img src="<?= $row['foto_kartu'] ?>" class="history-img me-3">
                                    <div class="flex-grow-1">
                                        <div class="fw-bold"><?= htmlspecialchars($row['nama_kartu']) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($row['jurusan_kartu']) ?></div>
                                    </div>
                                    <small class="text-muted"><?= $row['created_at'] ?></small>
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
