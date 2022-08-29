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
  $sql = "SELECT * FROM kategorije LIMIT 30";
  $res = $pdo->query($sql);
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <h1>Dodavanje nove šprance</h1>
    </div>
    <div class="row justify-content-center">
      <form method="POST" action="novo_unos.php">
        <label for="naslov">Naslov</label><br>
        <input type="text" id="naslov" name="naslov" size="90"><br>
        <span id="errNaslov"><br></span>
        <label for="tekst">Tekst šprance</label><br>
        <textarea name="tekst" id="tekst"></textarea>
        <span id="errTekst"><br></span>
        <label for="kategorije">Kategorija</label><br>
        <select id="kategorije" name="kategorije">
          <option value="31">Početna</option>
          <?php
          foreach ($res as $row) {
              echo "<option value='" . $row['id'] . "'>" . $row['naziv'] . "</option>";
          }
          ?>
        </select><br><br>
        <button id="dodaj" name="dodaj">Dodaj</button>
        <button type="reset" id="ponisti" name="ponisti">Poništi</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById("dodaj").onclick = function(event) {
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

