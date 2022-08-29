<head>
  <meta charset="UTF-8">
</head>
<?php
include "../db/connect.php";
session_start();
if ($_SESSION['$username'] == "" || $_SESSION['$admin'] == false) {
  header("Location: ../index.php");
}
if (isset($_POST['spremi'])) {
  $id = $_POST['id'];

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
  $stmt->bindColumn(6, $nazivKategorije);
  $stmt->fetch(PDO::FETCH_BOUND);

  $unosLogStaro = "Naslov: $naslov\n\nTekst: $tekst";

  $idKategorija = $_POST['idKategorija'];
  $unosNaslov = $_POST['naslov'];
  $unosTekst = $_POST['tekst'];
  $query1 = "UPDATE sprance SET naslov=?, tekst=? WHERE id=?";
  $stmt1 = $pdo->prepare($query1);
  $stmt1->execute([$unosNaslov, $unosTekst, $id]);

  $unosLogNovo = "Naslov: $unosNaslov\n\nTekst: $unosTekst";

  $query = "INSERT INTO logovi (radnja, stara_vrijednost, nova_vrijednost)
  VALUES (?, ?, ?)";
  $stmt2 = $pdo->prepare($query);
  $stmt2->execute(["Edit šprance", $unosLogStaro, $unosLogNovo]);
}
if ($idKategorija == 31) {
  header("Location: ../home.php");
} else {
  header("Location: ../kategorija.php?id=$idKategorija");
}
?>