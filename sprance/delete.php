<?php
include '../db/connect.php';
session_start();
if ($_SESSION['$username'] == "" || $_SESSION['$admin'] == false) {
  header("Location: ../index.php");
}
if(isset($_POST['del'])) {
  $id=$_POST['id'];

  $sql = "SELECT s.id AS sid, s.naslov, s.tekst, s.id_kategorija, k.id, k.naziv
    FROM sprance s
    JOIN kategorije k ON s.id_kategorija=k.id
    WHERE s.id=?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  $stmt->bindColumn(1, $id);
  $stmt->bindColumn(2, $naslov);
  $stmt->bindColumn(3, $tekst);
  $stmt->bindColumn(4, $SIdKategorija);
  $stmt->bindColumn(5, $idKategorija);
  $stmt->bindColumn(6, $nazivKategorija);
  $stmt->fetch(PDO::FETCH_BOUND);

  $unosLog = "Naslov: $naslov\n\nTekst: $tekst\n\nKategorija: $nazivKategorija";
  $query1 = "INSERT INTO logovi (radnja, stara_vrijednost)
  VALUES (?, ?)";
  $stmt1 = $pdo->prepare($query1);
  $stmt1->execute(["Brisanje šprance", $unosLog]);

  $query = "DELETE FROM sprance WHERE id=?";
  $stmt2 = $pdo->prepare($query);
  $stmt2->execute([$id]);
}
if ($SIdKategorija == 31) {
  header("Location: ../home.php");
} else {
  header("Location: ../kategorija.php?id=$SIdKategorija");
}
?>