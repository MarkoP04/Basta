<?php

session_start();

include '../config/db.php';
include '../classes/Korisnik.php';

$korisnik = new Korisnik($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $uspesno = $korisnik->registruj($_POST['ime'], $_POST['prezime'], $_POST['username'], $_POST['email'], $_POST['password']);
    if ($uspesno) {
        $_SESSION['success'] = "Uspešno ste se registrovali. Možete se sada prijaviti.";
        header("Location: ../pages/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Greška prilikom registracije. Pokušajte ponovo.";
        header("Location: ../pages/register.php");
        exit();
    }
}
?>