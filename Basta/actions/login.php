<?php

session_start();

include "../config/db.php";
include '../classes/Korisnik.php';

$korisnik = new Korisnik($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $korisnik->prijavi($_POST['username'], $_POST['password']);

    if ($user) {
        $_SESSION['korisnik_id'] = $user['korisnik_id'];
        header("Location: ../pages/moja_basta.php");
        exit();
    } else {
        $_SESSION['error'] = "Pogrešan username ili lozinka.";
        header("Location: ../pages/login.php");
        exit();
    }
}
?>