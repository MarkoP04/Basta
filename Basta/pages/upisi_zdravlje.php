<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Zdravlje.php';
require_once '../classes/Basta.php';
include '../includes/navbar.php';

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$zdravlje = new Zdravlje($conn);
$basta = new Basta($conn);
$korisnik_id = $_SESSION['korisnik_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'basta_id' => $_POST['basta_id'],
        'datum' => date('Y-m-d H:i:s'),
        'simptomi' => $_POST['simptomi'],
        'akcije' => $_POST['akcije'],
        'dijagnoza' => $_POST['dijagnoza']
    ];

    $uspesno = $zdravlje->create($data);

    if ($uspesno) {
        $_SESSION['success'] = "Zapisnik o zdravlju je uspešno dodat!";
        header("Location: zdravlje.php");
        exit();
    } else {
        $_SESSION['error'] = "Greška prilikom dodavanja zapisnika o zdravlju.";
    }
}

$biljkeKorisnika = $basta->sveBiljkeKorisnika($_SESSION['korisnik_id']);
?>
<head>
  <meta charset="UTF-8">
  <title>Dodaj zdravlje</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h2>Dodaj novi zapisnika o zdravlju</h2>
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
                                        <label for="simptomi" class="form-label">Simptomi:</label>
                                        <input type="text" class="form-control" name="simptomi" id="simptomi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dijagnoza" class="form-label">Dijagnoza:</label>
                                        <input type="text" class="form-control" name="dijagnoza" id="dijagnoza" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="akcije" class="form-label">Akcije:</label>
                                        <input type="text" class="form-control" name="akcije" id="akcije" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Dodaj zdravlje</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>