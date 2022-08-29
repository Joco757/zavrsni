<head>
  <meta charset="UTF-8">
</head>
<?php
include "../db/connect.php";
session_start();
if ($_SESSION['$username'] == "" || $_SESSION['$admin'] == false) {
  header("Location: ../index.php");
}

if (isset($_POST['prioritet'])) {
  $id1 = $_POST['id'];
  $prioritet1 = $_POST['prioritet'];
  $sql = "SELECT s.id AS sid, s.naslov, s.id_kategorija, s.prioritet, k.id
    FROM sprance s
    JOIN kategorije k ON s.id_kategorija=k.id
    WHERE s.id=?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id1]);
  $stmt->bindColumn(1, $id);
  $stmt->bindColumn(2, $unosNaslov);
  $stmt->bindColumn(3, $SIdKategorija);
  $stmt->bindColumn(4, $prioritet);
  $stmt->bindColumn(5, $idKategorija);
  $stmt->fetch(PDO::FETCH_BOUND);

  $unosLogStaro = "Naslov: $unosNaslov\n\nPrioritet: $prioritet";
  $unosLogNovo = "Naslov: $unosNaslov\n\nPrioritet: $prioritet1";
  $query = "INSERT INTO logovi (radnja, stara_vrijednost, nova_vrijednost)
  VALUES (?, ?, ?)";
  $stmt1 = $pdo->prepare($query);
  $stmt1->execute(["Promjena prioriteta šprance", $unosLogStaro, $unosLogNovo]);

  $prioritet = $prioritet1;

  $query1 = "UPDATE sprance SET prioritet=? WHERE id=?";
  $stmt2 = $pdo->prepare($query1);
  $stmt2->execute([$prioritet, $id]);

  if ($idKategorija == 31) {
    header("Location: ../home.php");
  } else {
    header("Location: ../kategorija.php?id=$idKategorija");
  }
}
?>