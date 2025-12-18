<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
      <div class="container">
        <div class="d-flex w-100 justify-content-between align-items-center">
          <a class="btn btn-outline-light" href="profile.php">
            <i class="bi bi-person-circle"></i> Profil
          </a>

          <span class="navbar-brand mb-0 h1 mx-auto">ID Card System</span>

          <a class="btn btn-danger" href="logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </div>
      </div>
    </nav>

    <div class="root"></div>
    
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>