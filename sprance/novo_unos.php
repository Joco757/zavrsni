<head>
  <meta charset="UTF-8">
</head>
<?php
include "../db/connect.php";
session_start();
if ($_SESSION['$username'] == "" || $_SESSION['$admin'] == false) {
  header("Location: ../index.php");
}
if (isset($_POST['dodaj'])) {

  $unosNaslov = $_POST['naslov'];
  $unosTekst = $_POST['tekst'];
  $unosKategorija = $_POST['kategorije'];
  $query = "INSERT INTO sprance (naslov, tekst, id_kategorija) 
  VALUES (?, ?, ?)";
  $stmt1 = $pdo->prepare($query);
  $stmt1->execute([$unosNaslov, $unosTekst, $unosKategorija]);

  $sql = "SELECT s.id AS sid, s.id_kategorija, k.id, k.naziv
    FROM sprance s
    JOIN kategorije k ON s.id_kategorija=k.id
    WHERE k.id=?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$unosKategorija]);
  $stmt->bindColumn(1, $id);
  $stmt->bindColumn(2, $SIdKategorija);
  $stmt->bindColumn(3, $idKategorija);
  $stmt->bindColumn(4, $nazivKategorija);
  $stmt->fetch(PDO::FETCH_BOUND);

  $unosLog = "Naslov: $unosNaslov\n\nTekst: $unosTekst\n\nKategorija: $nazivKategorija";
  $query1 = "INSERT INTO logovi (radnja, nova_vrijednost)
  VALUES (?, ?)";
  $stmt1 = $pdo->prepare($query1);
  $stmt1->execute(["Unos nove šprance", $unosLog]);
}
if ($unosKategorija == 31) {
  header("Location: ../home.php");
} else {
  header("Location: ../kategorija.php?id=$unosKategorija");
}
?>