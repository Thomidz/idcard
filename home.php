<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ID Card System</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/homestyle.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm custom-navbar">
  <div class="container-fluid px-4 px-lg-5">

    <a class="navbar-brand fw-bold" href="home.php">
      <i class="bi bi-credit-card-2-front-fill me-2"></i>
      ID Card System
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center"
             href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle fs-5 me-2"></i>
            Akun
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
              <a class="dropdown-item" href="profile.php">
                <i class="bi bi-person me-2"></i> Profil
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger" href="logout.php">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>

<!-- ===== CONTENT ===== -->
<div class="container mt-5">
  <div class="row justify-content-between">

    <!-- FORM -->
    <div class="col-lg-5 mt-5">
      <div class="card form-card">
        <div class="card-body">
          <h5 class="text-center mb-3 text-success fw-bold">FORM ID CARD</h5>

          <form id="FORMIDCARD">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" id="Nama" required>
            </div>

            <div class="mb-3">
              <label class="form-label">NIM</label>
              <input type="text" class="form-control" id="NIM" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jurusan</label>
              <input type="text" class="form-control" id="JURUSAN" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Upload Foto</label>
              <input type="file" class="form-control" id="Gambar" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-success w-100">
              MAKE ID CARD
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- RESULT -->
    <div class="col-lg-5 mt-5">
      <div class="card result-card">
        <div class="card-header text-center fw-bold text-success">
          RESULT
        </div>

        <div class="card-body d-flex flex-column align-items-center gap-3">
          <div class="id-card-container"></div>

          <!-- BUTTON PDF -->
          <button id="btnPdf" class="btn btn-outline-success d-none">
            <i class="bi bi-file-earmark-pdf"></i> Save as PDF
          </button>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ===== JS LIBRARY ===== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- ===== CUSTOM JS ===== -->
<script src="java/script.js"></script>

</body>
</html>
