<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID CARD USU - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="root">
        <?php if(!isset($_SESSION['user'])): ?>
            <div class="card" style="width: 30rem; padding: 25px; border-radius: 15px;">
                <h3 class="text-center mb-4">LOGIN ID CARD</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button name="login" class="btn btn-primary w-100 text-white">MASUK</button>
                </form>
                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
                </div>
            </div>
        <?php else: ?>
            <div class="header"><h3>Selamat Datang, <?php echo $_SESSION['user']['nama']; ?></h3></div>
            <div class="id-card-container">
                <div class="id-card">
                    <div class="id-cardhead">ID CARD</div>
                    <img src="uploads/<?php echo $_SESSION['user']['foto_path']; ?>" alt="Profile" onerror="this.src='https://via.placeholder.com/170'">
                    <div class="Nama"><?php echo $_SESSION['user']['nama']; ?></div>
                    <div class="NIM">(<?php echo $_SESSION['user']['nim']; ?>)</div>
                    <div class="class"><?php echo $_SESSION['user']['jurusan']; ?></div>
                    <div class="USU">UNIVERSITAS SUMATERA UTARA</div>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <a href="profile.php" class="btn btn-secondary text-white">Settings</a>
                <a href="logout.php" class="btn btn-danger text-white">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
if(isset($_POST['login'])){
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $pass = $_POST['password'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE nim='$nim'");
    if($user = mysqli_fetch_assoc($query)){
        if(password_verify($pass, $user['password'])){
            $_SESSION['user'] = $user;
            echo "<script>window.location='index.php';</script>";
        }
    }
}
?>