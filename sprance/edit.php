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
  <script src='../tinymce/tinymce.min.js'></script>
  <script>
    tinymce.init({
      selector: '#tekst',
      plugins: 'preview searchreplace autolink directionality code visualblocks visualchars fullscreen link table charmap anchor insertdatetime advlist lists wordcount help charmap emoticons',
      menubar: 'file edit view insert format tools table help',
      toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize styles | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap emoticons | fullscreen preview | link anchor | ltr rtl',
      toolbar_sticky: true,
      toolbar_mode: 'sliding',
      width: 874,
      height: 500
    });
  </script>
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
  if (isset($_POST['edit'])) {
    $id1 = $_POST['id'];
    $sql = "SELECT s.id AS sid, s.naslov, s.tekst, s.id_kategorija, k.id, k.naziv
      FROM sprance s
      JOIN kategorije k ON s.id_kategorija=k.id
      WHERE s.id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id1]);
    $stmt->bindColumn(1, $id);
    $stmt->bindColumn(2, $naslov);
    $stmt->bindColumn(3, $tekst);
    $stmt->bindColumn(4, $SIdKategorija);
    $stmt->bindColumn(5, $idKategorija);
    $stmt->bindColumn(6, $nazivKategorije);
    $stmt->fetch(PDO::FETCH_BOUND);
  }
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <h1>Uređivanje šprance</h1>
    </div>
    <div class="row justify-content-center">
      <form method="POST" action="unos.php">
        <input type='hidden' name='id' value='<?php echo $id; ?>'>
        <input type='hidden' name='idKategorija' value='<?php echo $idKategorija; ?>'>
        <label for="naslov">Naslov</label><br>
        <input type="text" id="naslov" name="naslov" size="90" value="<?php echo $naslov; ?>"><br>
        <span id="errNaslov"><br></span>
        <label for="tekst">Tekst šprance</label><br>
        <textarea name="tekst" id="tekst"><?php echo $tekst; ?></textarea>
        <span id="errTekst"><br></span>
        <button id="spremi" name="spremi">Spremi</button>
        <button type="reset" id="ponisti" name="ponisti">Poništi</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById("spremi").onclick = function(event) {
      let slanjeForme = true;

      let poljeNaslov = document.getElementById("naslov");
      let naslov = document.getElementById("naslov").value;
      poljeNaslov.style.border = "";
      document.getElementById("errNaslov").innerHTML = "<br>";
      if (naslov.length == 0) {
        slanjeForme = false;
        poljeNaslov.style.border = "3px solid red";
        document.getElementById("errNaslov").innerHTML = "Naslov ne smije biti prazan!<br>";
      }

      let a = document.getElementsByClassName("tox-tinymce");
      let poljeTekst = a[0];
      let tekst = document.getElementById("tekst").value;
      poljeTekst.style.border = "";
      document.getElementById("errTekst").innerHTML = "<br>";
      if ((tinymce.EditorManager.get('tekst').getContent()) == '') {
        slanjeForme = false;
        poljeTekst.style.border = "3px solid red";
        document.getElementById("errTekst").innerHTML = "Tekst šprance ne smije biti prazan!<br>";
      }

      if (slanjeForme != true) {
        event.preventDefault();
      }
    };

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

  <footer class="footer">
    <?php
    require "../dijelovi_stranice/footer.php";
    echo $footer;
    ?>
  </footer>

</body>

</html>

