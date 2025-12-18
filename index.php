<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID CARD USU | Portal Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="root">
        <?php if(!isset($_SESSION['user'])): ?>
            <div class="login-wrapper">
                <div class="login-card">
                    <div class="login-header text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/id/thumb/d/d4/Logo_USU.png/800px-Logo_USU.png" alt="Logo USU" style="width: 80px; margin-bottom: 15px;">
                        <h3>Sistem ID Card USU</h3>
                        <p class="text-muted">Silakan masuk dengan NIM Anda</p>
                    </div>
                    <form method="POST" class="mt-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="nim" class="form-control rounded-pill px-4" id="floatingInput" placeholder="NIM" required>
                            <label for="floatingInput" class="px-4">NIM Mahasiswa</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control rounded-pill px-4" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword" class="px-4">Password</label>
                        </div>
                        <button name="login" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">MASUK KE PORTAL</button>
                    </form>
                    <div class="text-center mt-4">
                        <p class="small">Mahasiswa baru? <a href="register.php" class="text-primary text-decoration-none fw-bold">Daftar Akun</a></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container text-center py-5">
                <div class="welcome-text mb-5">
                    <h2 class="fw-bold">Selamat Datang, <?php echo $_SESSION['user']['nama']; ?></h2>
                    <p class="text-muted">Berikut adalah kartu identitas digital mahasiswa Anda.</p>
                </div>

                <div class="id-card-wrapper">
                    <div class="id-card">
                        <div class="id-card-top">
                            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/d/d4/Logo_USU.png/800px-Logo_USU.png" alt="Logo USU">
                            <div class="univ-info">
                                <h5>UNIVERSITAS SUMATERA UTARA</h5>
                                <p>KARTU IDENTITAS MAHASISWA</p>
                            </div>
                        </div>
                        <div class="id-card-body">
                            <div class="photo-frame">
                                <img src="uploads/<?php echo $_SESSION['user']['foto_path']; ?>" onerror="this.src='https://via.placeholder.com/150'">
                            </div>
                            <div class="student-info">
                                <h4 class="student-name"><?php echo strtoupper($_SESSION['user']['nama']); ?></h4>
                                <p class="student-nim"><?php echo $_SESSION['user']['nim']; ?></p>
                                <div class="badge-jurusan"><?php echo $_SESSION['user']['jurusan']; ?></div>
                            </div>
                        </div>
                        <div class="id-card-footer">
                            <span>AKTIF - 2024/2025</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 d-flex justify-content-center gap-3">
                    <a href="profile.php" class="btn btn-outline-dark rounded-pill px-4">Pengaturan Profil</a>
                    <a href="logout.php" class="btn btn-danger rounded-pill px-4">Keluar Sistem</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>