<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Zalivanje.php';
require_once '../classes/Basta.php';
include '../includes/navbar.php';

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$zalivanje = new Zalivanje($conn);
$basta = new Basta($conn);
$korisnik_id = $_SESSION['korisnik_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'basta_id' => $_POST['basta_id'],
        'datum' => date('Y-m-d H:i:s'),
        'kolicina' => $_POST['kolicina']
    ];

    $uspesno = $zalivanje->dodajZalivanje($data);

    if ($uspesno) {
        $_SESSION['success'] = "Zalivanje uspešno dodato!";
        header("Location: zalivanje.php");
        exit();
    } else {
        $_SESSION['error'] = "Greška prilikom dodavanja zalivanja.";
    }
}

$biljkeKorisnika = $basta->sveBiljkeKorisnika($_SESSION['korisnik_id']);
?>
<head>
  <meta charset="UTF-8">
  <title>Dodaj zalivanje</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4 shadow-sm">
    <h2>Dodaj novo zalivanje</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="basta_id" class="form-label">Biljka:</label>
            <select class="form-select" name="basta_id" id="basta_id" required>
                <?php foreach ($biljkeKorisnika as $biljka): ?>
                    <option value="<?= $biljka['basta_id']; ?>">
                        <?= htmlspecialchars($biljka['nadimak'] ?? $biljka['naziv']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kolicina" class="form-label">Količina vode (npr. 200ml):</label>
            <input type="text" class="form-control" name="kolicina" id="kolicina" required>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj zalivanje</button>
    </form>
</div>
                </div>
                </div>
                </div>
</body>