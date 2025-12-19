<?php 
include 'db.php'; 

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE nim = '$nim'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: home.php");
            exit();
        } else {
            $error = "Password yang Anda masukkan salah.";
        }
    } else {
        $error = "NIM tidak terdaftar di sistem.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem ID Card USU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="bg-decoration"></div>
    <div class="root">
        <div class="container d-flex justify-content-center">
            <div class="card card-login" style="max-width: 400px; width: 100%;">
                <div class="card-body">
                    <div class="login-header text-center">
                        <h3>Selamat Datang</h3>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div><?php echo $error; ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                            <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-login mb-3">Masuk ke Sistem</button>
                        </div>
                        
                        <div class="text-center mt-2">
                            <span class="text-muted small">Belum memiliki akun?</span> 
                            <a href="register.php" class="text-success small fw-bold text-decoration-none ms-1">Daftar Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>