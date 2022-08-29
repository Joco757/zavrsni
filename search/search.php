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
  if (isset($_POST['search'])) {
    $search = $_POST["kljRijec"];

    $unosLog = "Pretražena riječ: $search";
    $query1 = "INSERT INTO logovi (radnja, nova_vrijednost)
    VALUES (?, ?)";
    $stmt = $pdo->prepare($query1);
    $stmt->execute(["Search", $unosLog]);

    $sql = "SELECT s.id AS sid, s.naslov, s.tekst, s.id_kategorija, k.id, k.naziv as knaziv
    FROM sprance s
    JOIN kategorije k ON s.id_kategorija=k.id
    WHERE s.naslov LIKE '%$search%' OR s.tekst LIKE '%$search%'";
    $res = $pdo->query($sql);
  }
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <h1>Rezultati pretraživanja</h1>
    </div>
    <div class="row justify-content-center">
      <div id="search1">
        <?php
        foreach ($res as $row) {
          echo "
              <i>" . $row['knaziv'] . "</i>
              <h4>" . $row["naslov"] . "</h4><br>
              <div>";
          echo nl2br($row['tekst']);
          echo "</div><br>
              <hr><hr>
              <br>
            ";
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
    let rijec = "<?php echo $search; ?>";
    let rijec1 = rijec.charAt(0).toUpperCase() + rijec.slice(1);
    let rijec2 = rijec.toLowerCase();
    let rijec3 = rijec.toUpperCase();
    let br = 0;

    let text = document.getElementById("search1").innerHTML;
    let re = new RegExp(rijec, "g");
    let newText = text.replace(re, `<span class='highlight'>${rijec}</span>`);
    document.getElementById("search1").innerHTML = newText;

    text = document.getElementById("search1").innerHTML;
    let re1 = new RegExp(rijec1, "g");
    let newText1 = text.replace(re1, `<span class='highlight'>${rijec1}</span>`);
    document.getElementById("search1").innerHTML = newText1;

    text = document.getElementById("search1").innerHTML;
    let re2 = new RegExp(rijec2, "g");
    let newText2 = text.replace(re2, `<span class='highlight'>${rijec2}</span>`);
    document.getElementById("search1").innerHTML = newText2;

    text = document.getElementById("search1").innerHTML;
    let re3 = new RegExp(rijec3, "g");
    let newText3 = text.replace(re3, `<span class='highlight'>${rijec3}</span>`);
    document.getElementById("search1").innerHTML = newText3;


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