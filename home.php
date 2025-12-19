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

<div class="container mt-5">
  <div class="row justify-content-center">

    <div class="col-lg-5 mt-5">
      <div class="card form-card">
        <div class="card-body">
          <h5 class="text-center mb-3 text-success fw-bold">
            FORM ID CARD
          </h5>

          <form id="FORMIDCARD">
            <div class="mb-3">
              <label for="Nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="Nama" placeholder="Nama Lengkap" required>
            </div>

            <div class="mb-3">
              <label for="NIM" class="form-label">NIM</label>
              <input type="text" class="form-control" id="NIM" placeholder="Nomor Induk Mahasiswa" required>
            </div>

            <div class="mb-3">
              <label for="JURUSAN" class="form-label">Jurusan</label>
              <input type="text" class="form-control" id="JURUSAN" placeholder="Program Studi" required>
            </div>

            <div class="mb-3">
              <label for="Gambar" class="form-label">Upload Foto</label>
              <input type="file" class="form-control" id="Gambar" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-success w-100">
              MAKE ID CARD
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-5 mt-5">
      <div class="card result-card">
        <div class="card-header text-center fw-bold text-success">
          RESULT
        </div>
        <div class="card-body d-flex justify-content-center">
          <div class="id-card-container"></div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
document.getElementById("FORMIDCARD").addEventListener("submit", function (event) {
    event.preventDefault();

    const Nama = document.getElementById("Nama").value;
    const NIM = document.getElementById("NIM").value;
    const JURUSAN = document.getElementById("JURUSAN").value;
    const Gambar = document.getElementById("Gambar");

    if (Gambar.files && Gambar.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageSrc = e.target.result;

            displayIDCard(Nama, NIM, JURUSAN, imageSrc);

            const formData = new FormData();
            formData.append("nama", Nama);
            formData.append("jurusan", JURUSAN);
            formData.append("foto", imageSrc);

            fetch("save_history.php", {
                method: "POST",
                body: formData
            });
        };
        reader.readAsDataURL(Gambar.files[0]);
    }
});

function displayIDCard(Nama, NIM, JURUSAN, imageSrc) {
    document.querySelector(".id-card-container").innerHTML = `
      <div class="id-card border p-3 text-center shadow"
           style="width:300px;border-radius:15px;background:white;">
        <div class="fw-bold border-bottom mb-2 pb-1">ID CARD USU</div>
        <img src="${imageSrc}" class="img-thumbnail mb-2"
             style="width:150px;height:180px;object-fit:cover;">
        <div class="fw-bold text-uppercase">${Nama}</div>
        <div class="text-muted small">${NIM}</div>
        <div class="fw-semibold">${JURUSAN}</div>
        <div class="mt-3 text-primary fw-bold" style="font-size:0.8rem;">
          UNIVERSITAS SUMATERA UTARA
        </div>
      </div>
    `;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
