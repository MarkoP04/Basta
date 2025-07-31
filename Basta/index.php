<?php
include 'config/db.php';
include 'includes/navbar.php';

$sql = "SELECT * FROM biljke";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Biljke</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="custom-bg">
    <div class="container py-5">
        <h1 class="mb-4 text-center">Biblioteka Biljaka</h1>
        <div class="row g-4">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="assets/images/<?php echo $row['slika']; ?>" class="card-img-top" alt="Slika biljke">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['naziv']; ?></h5>
                            <p class="card-text"><strong>Latinski naziv:</strong> <em><?php echo $row['latinski_naziv']; ?></em></p>
                            <p class="card-text"><strong>Tip:</strong> <?php echo $row['tip']; ?></p>
                            <p class="card-text"><strong>Osvetljenje:</strong> <?php echo $row['osvetljenje']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
