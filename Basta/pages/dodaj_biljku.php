<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Basta.php';
require_once '../classes/Biljka.php';
include '../includes/navbar.php';

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$basta = new Basta($conn);
$biljka = new Biljka($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'korisnik_id' => $_SESSION['korisnik_id'],
        'biljka_id' => $_POST['biljka_id'],
        'datum_dodavanja' => date('Y-m-d H:i:s'),
        'nadimak' => $_POST['nadimak'],
        'lokacija' => $_POST['lokacija']
    ];

    $uspesno = $basta->create($data);

    if ($uspesno) {
        $_SESSION['success'] = "Biljka je uspešno dodata u tvoju baštu!";
        header("Location: moja_basta.php");
        exit();
    } else {
        $_SESSION['error'] = "Greška prilikom dodavanja biljke.";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Dodaj biljku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4 shadow-sm">
          <h2 class="text-center mb-4">Izaberi biljku</h2>
          <form method="POST" action="">
            <div class="mb-3">
                <select class="form-select" name="biljka_id" id="biljka_id" required>
                    <?php
                    $biljke = $biljka->sveBiljke();
                    foreach ($biljke as $b):
                    ?>
                    <option value="<?= $b['biljka_id']; ?>"><?= htmlspecialchars($b['naziv']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nadimak" class="form-label">Nadimak biljke:</label>
                <input type="text" class="form-control" name="nadimak" id="nadimak" required>
            </div>
            <div class="mb-3">
                <label for="lokacija" class="form-label">Lokacija biljke:</label>
                <input type="text" class="form-control" name="lokacija" id="lokacija" required>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-success">Dodaj biljku</button>
                <a href="moja_basta.php" class="btn btn-danger">Nazad</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</body>