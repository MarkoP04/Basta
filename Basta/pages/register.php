<head>
  <meta charset="UTF-8">
  <title>Registracija</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4 shadow-sm">
          <h2 class="text-center mb-4">Registracija</h2>
          <div class="container mt-2">
            <form action="../actions/register.php" method="post">
              <div class="form-group mb-3">
                <label for="ime">Ime:</label>
                <input type="text" class="form-control" id="ime" name="ime" placeholder="Unesite Vase ime" required>
              </div>
              <div class="form-group mb-3">
                <label for="prezime">Prezime:</label>
                <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Unesite Vase prezime" required>
              </div>
              <div class="form-group mb-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Unesite username" required>
              </div>
              <div class="form-group mb-3">
                <label for="password">Lozinka:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Unesite lozinku" required>
              </div>
              <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Unesite email" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Registrujte se</button>
            </form>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <div>
                Imate nalog? <a href="../pages/login.php">Prijavite se</a>
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