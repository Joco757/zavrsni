<?php
include '../db/connect.php';
session_start();
if ($_SESSION['$username'] == "") {
  header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "../dijelovi_stranice/header.php";
  echo $header;
  ?>
</head>

<body>
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>

  <?php
  require "../dijelovi_stranice/navigation.php";
  echo "$navigation1 $navigation2 $navigation3";
  ?>

  <a id="back2Top" title="Back to top" href="#">&#10148;</a>

  <div id="display"></div>

  <?php
  $sql = "SELECT s.id AS sid, s.naslov, s.tekst, s.id_kategorija, k.id, k.naziv as knaziv
  FROM sprance s
  JOIN kategorije k ON s.id_kategorija=k.id
  ORDER BY k.id DESC";
  $res = $pdo->query($sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <h1>Popis špranci</h1>
    </div>
    <div class="row justify-content-center">
      <div id="search1">
        <?php
        foreach ($res as $row) {
          if ($row['id_kategorija'] == 31) {
            echo "<a href='../home.php'>" . $row['knaziv'] . " - " . $row['naslov'] . "</a><br><br>";
          } else {
            echo "<a href='../kategorija.php?id=" . $row['id_kategorija'] . "'>" . $row['knaziv'] . " - " . $row['naslov'] . "</a><br><br>";
          }
        }
        ?>
      </div>
    </div>
  </div>

  <footer class="footer">
    <?php
    require "../dijelovi_stranice/footer.php";
    echo $footer;
    ?>
  </footer>

  <script>
    document.getElementById("search").onclick = function(event) {
      let slanjeForme = true;

      let poljeKljRijec = document.getElementById("kljRijec");
      let kljRijec = document.getElementById("kljRijec").value;
      let errKlj = document.getElementById("errKlj");
      if (kljRijec.length == 0) {
        slanjeForme = false;
        errKlj.removeAttribute("hidden");
        poljeKljRijec.style.border = "3px solid red";
        errKlj.innerHTML = "Ne smije biti prazno";
      }

      if (slanjeForme != true) {
        event.preventDefault();
      }
    };
  </script>

</body>

</html>