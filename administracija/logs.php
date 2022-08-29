<?php
include '../db/connect.php';
session_start();
if ($_SESSION['$username'] == "" || $_SESSION['$admin'] == false) {
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
  $sql = "SELECT * FROM logovi ORDER BY id DESC";
  $res = $pdo->query($sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <h1>Logovi</h1>
    </div>
    <div class="row justify-content-center">
      <div id="search1">
        <table>
          <tr>
            <th>Timestamp</th>
            <th>Radnja</th>
            <th>Stara vrijednost</th>
            <th>Nova vrijednost</th>
          </tr>
          <?php
          foreach ($res as $row) {
            echo "<tr>";
            echo "<td>" . $row['timestamp'] . "</td>";
            echo "<td>" . $row['radnja'] . "</td>";
            echo "<td>";
            echo nl2br($row['stara_vrijednost']);
            echo "</td>";
            echo "<td>";
            echo nl2br($row['nova_vrijednost']);
            echo "</td>";
            echo "</tr>";
          }
          ?>
        </table>
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