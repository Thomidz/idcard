<?php 
include 'db.php'; 

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$success = false;
if(isset($_POST['register'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Cek apakah NIM sudah terdaftar
    $check = mysqli_query($conn, "SELECT nim FROM users WHERE nim = '$nim'");
    if(mysqli_num_rows($check) > 0) {
        $error = "NIM sudah terdaftar dalam sistem.";
    } else {
        $query = "INSERT INTO users (nama, nim, jurusan, password) VALUES ('$nama', '$nim', '$jurusan', '$pass')";
        if(mysqli_query($conn, $query)){
            echo "<script>alert('Berhasil Daftar! Silakan Login.'); window.location='login.php';</script>";
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Sistem ID Card USU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --usu-green: #1a5c2b;
            --usu-gold: #c5a059;
            --soft-gray: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0e0e0 0%, #ffffff 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .root {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-decoration {
            position: fixed;
            width: 500px;
            height: 500px;
            background: rgba(26, 92, 43, 0.05);
            border-radius: 50%;
            z-index: -1;
            bottom: -100px;
            left: -100px;
        }

        .card-register {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 450px;
        }

        .register-header h3 {
            font-weight: 700;
            color: var(--usu-green);
            letter-spacing: -0.5px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            margin-left: 4px;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.65rem 1rem;
            border: 2px solid #eee;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--usu-green);
            box-shadow: none;
        }

        .btn-register {
            background: linear-gradient(to right, var(--usu-green), #2d8a41);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 92, 43, 0.3);
            color: white;
        }

        .brand-logo {
            width: 60px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="bg-decoration"></div>
    <div class="root">
        <div class="container d-flex justify-content-center">
            <div class="card card-register">
                <div class="card-body">
                    <div class="register-header text-center">
                        <h3>Buat Akun Baru</h3>
                        <p class="text-muted small mb-4">Lengkapi data untuk akses ID Card</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger p-2 small text-center" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Contoh: 231401XXX" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Teknologi Informasi" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="register" class="btn btn-register mb-3">Daftar Sekarang</button>
                        </div>
                        
                        <div class="text-center mt-2">
                            <span class="text-muted small">Sudah memiliki akun?</span> 
                            <a href="login.php" class="text-success small fw-bold text-decoration-none ms-1">Login di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>