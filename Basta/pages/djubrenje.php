<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Djubrenje.php';
include '../includes/navbar.php';

if (!isset($_SESSION['korisnik_id'])) {
    header("Location: login.php");
    exit();
}

$djubrenje = new Djubrenje($conn);
$korisnik_id = $_SESSION['korisnik_id'];
$podaci = $djubrenje->djubrenjaPoKorisniku($korisnik_id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>djubrenje biljaka</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
    <div class="container-fluid">
        <div class="row">
            <?php include '../includes/navigacija.php';?>
            <div class="col-md-11 d-flex flex-column align-items-center p-5">
                <h1 class="text-center mb-4">Djubrenje biljaka</h1>
                <div class="d-flex justify-content-center mb-5">
                    <a href="upisi_djubrenje.php" class="btn btn-success me-3">Upisi djubrenje</a>
                </div>
                <div class="list-group overflow-auto" style="max-height: 500px;">
                    <?php foreach ($podaci as $z): ?>
                        <div class="list-group-item">
                            <strong><?= htmlspecialchars($z['nadimak']) ?> (<?= htmlspecialchars($z['naziv']) ?>)</strong><br>
                            Datum: <?= htmlspecialchars($z['datum']) ?><br>
                            Tip: <?= htmlspecialchars($z['tip']) ?><br>
                            Količina djubriva: <?= htmlspecialchars($z['kolicina']) ?> g
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>