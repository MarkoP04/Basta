<?php
session_start();
?>
<head>
  <meta charset="UTF-8">
  <title>Prijava</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4 shadow-sm">
          <h2 class="text-center mb-4">Prijava korisnika</h2>
          <div class="container mt-2">
            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
              </div>
              <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error']; ?>
              </div>
              <?php unset($_SESSION['error']); ?>
              <?php endif; ?>
              <form method="post" action="../actions/login.php">
                <div class="mb-3">
                  <label for="username" class="form-label">Username:</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Unesite username" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Lozinka:</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Unesite lozinku" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Prijavi se</button>
              </form>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                  Nemate nalog? <a href="../pages/register.php">Registrujte se</a>
                </div>
                <div>
                  <a href="../index.php" class="btn btn-secondary">Početna</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
