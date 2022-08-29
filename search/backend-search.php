<?php
include '../db/connect.php';

if (isset($_POST['query'])) {

  $query = "SELECT s.id AS sid, s.naslov, s.tekst, s.id_kategorija, k.id, k.naziv as knaziv
  FROM sprance s
  JOIN kategorije k ON s.id_kategorija=k.id
  WHERE s.naslov LIKE '%{$_POST['query']}%' OR s.tekst LIKE '%{$_POST['query']}%'";
  $stmt = $pdo->query($query);

  foreach ($stmt as $row) {
    if ($row['id_kategorija'] == 31) {
      echo "<a style='display: block;' href='../home.php'>".$row['naslov']."</a> <hr>";
    } else {
      echo "<a style='display: block;' href='../kategorija.php?id=". $row['id_kategorija'] ."'>".$row['naslov']."</a> <hr>";
    }
  }
}
?>

