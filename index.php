<?php
include 'db/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "dijelovi_stranice/header_root.php";
  echo $header;
  ?>
</head>

<body>
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>

  <a href="#/"><img src="img/crescent.svg" height="25px" id="theme-toggle" class="theme-index theme" title="Promjena teme"></a>

  <a id="back2Top" title="Back to top" href="#">&#10148;</a>

  <div class="container">
    <div class="row justify-content-center">
      <img class="logo" src="img/logo-helpdesk.png" width="400px">
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-3">
        <form action="home.php" method="POST">
          <label for="korime">Korisničko ime</label><br>
          <input type="text" id="korime" name="korime"><br>
          <span id="errKorime"><br></span>
          <label for="loz">Lozinka</label><br>
          <input type="password" id="loz" name="loz"><br>
          <span id="errLoz"><br></span>
          <input type="submit" value="Prijavi se" id="prijava" name="prijava">
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("prijava").onclick = function(event) {
      let slanjeForme = true;

      let poljeKorime = document.getElementById("korime");
      let korime = document.getElementById("korime").value;
      poljeKorime.style.border = "";
      document.getElementById("errKorime").innerHTML = "<br>";
      if (korime.length == 0) {
        slanjeForme = false;
        poljeKorime.style.border = "3px solid red";
        document.getElementById("errKorime").innerHTML = "Unesite korisničko ime!<br>";
      }

      let poljeLoz = document.getElementById("loz");
      let loz = document.getElementById("loz").value;
      poljeLoz.style.border = "";
      document.getElementById("errLoz").innerHTML = "<br>";
      if (loz.length == 0) {
        slanjeForme = false;
        poljeLoz.style.border = "3px solid red";
        document.getElementById("errLoz").innerHTML = "Unesite lozinku!<br>";
      }

      if (slanjeForme != true) {
        event.preventDefault();
      }
    };
  </script>

  <footer class="footer">
    <?php
    require "dijelovi_stranice/footer_root.php";
    echo $footer;
    ?>
  </footer>

</body>

</html>

