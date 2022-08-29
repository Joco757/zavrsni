<?php
include "../db/connect.php";
session_start();
$imeKorisnika = $_SESSION['$username'];
$admin = $_SESSION['$admin'];
if ($admin == true){
    $admin = "true";
} else if ($admin == false){
    $admin = "false";
}
$unosLog = "Korisnik: $imeKorisnika\n\nAdmin: $admin";
$query1 = "INSERT INTO logovi (radnja, nova_vrijednost)
VALUES (?, ?)";
$stmt = $pdo->prepare($query1);
$stmt->execute(["Odjava korisnika", $unosLog]);
session_unset();
header("Location:../index.php");
?>