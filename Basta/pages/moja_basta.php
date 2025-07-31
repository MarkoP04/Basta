<?php

session_start();

include '../config/db.php';
include '../includes/navbar.php';
include '../classes/Basta.php';

if(!isset($_SESSION['korisnik_id'])){
    header("Location: login.php");
    exit();
}

$basta = new Basta($conn);
$biljkeKorisnika = $basta->sveBiljkeKorisnika($_SESSION['korisnik_id']);

?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Moja bašta</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
    <div class="container-fluid">
        <div class="row">
            
            <?php include '../includes/navigacija.php';?>

            <div class="col-md-11 d-flex flex-column align-items-center p-5">
                <h1 class="text-center mb-4">Moja bašta</h1>

                <div class="d-flex justify-content-center mb-5">
                    <a href="dodaj_biljku.php" class="btn btn-success me-3">Dodaj biljku</a>
                    <a href="ukloni_biljku.php" class="btn btn-danger">Ukloni biljku</a>
                </div>

                <div class="container mt-5">

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if (!empty($biljkeKorisnika)): ?>
    <?php foreach ($biljkeKorisnika as $biljka): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="../assets/images/<?= htmlspecialchars($biljka['slika']); ?>" class="card-img-top" alt="<?= htmlspecialchars($biljka['naziv']); ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($biljka['nadimak']); ?> (<?= htmlspecialchars($biljka['naziv']); ?>)</h5>
            <p class="card-text"><strong>Latinski naziv:</strong> <em><?= htmlspecialchars($biljka['latinski_naziv']); ?></em></p>
            <p class="card-text"><strong>Tip:</strong> <?= htmlspecialchars($biljka['tip']); ?></p>
            <p class="card-text"><strong>Lokacija:</strong> <?= htmlspecialchars($biljka['lokacija']); ?></p>
            <p class="card-text"><strong>Osvetljenje:</strong> <?= htmlspecialchars($biljka['osvetljenje']); ?></p>
            <p class="card-text"><strong>Zalivanje:</strong> <?= htmlspecialchars($biljka['zalivanje_dani']); ?></p>
            <p class="card-text"><strong>Kolicina vode:</strong> <?= htmlspecialchars($biljka['kolicina_vode']); ?></p>
            <p class="card-text"><strong>Djubrenje:</strong> <?= htmlspecialchars($biljka['djubrenje_dani']); ?></p>
            <p class="card-text"><strong>Tip djubriva:</strong> <?= htmlspecialchars($biljka['tip_djubriva']); ?></p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Dodato: <?= date('d.m.Y. H:i', strtotime($biljka['datum_dodavanja'])); ?></small>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php else: ?>
  <p class="col-md-11 d-flex flex-column align-items-center p-5">Još uvek nemaš nijednu biljku u tvojoj bašti.</p>
<?php endif; ?>
  </div>
</div>


            </div>
        </div>
    </div>
</body>
</html>