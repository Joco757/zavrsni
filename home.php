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

  <?php
  session_start();
  if (isset($_POST["prijava"])) {
    $loginKorisnik = $_POST["korime"];
    $loginLozinka = $_POST["loz"];
    $sql1 = "SELECT username, password, admin FROM users
      WHERE username = ?";

    $stmt = $pdo->prepare($sql1);
    $stmt->execute([$loginKorisnik]);
    $stmt->bindColumn(1, $imeKorisnika);
    $stmt->bindColumn(2, $lozinkaKorisnika);
    $stmt->bindColumn(3, $levelKorisnika);
    $stmt->fetch(PDO::FETCH_BOUND);

    if (($_POST['loz'] == $lozinkaKorisnika)) {
      $_SESSION['$uspjesnaPrijava'] = true;
      if ($levelKorisnika == 1) {
        $_SESSION['$admin'] = true;
        $admin = "true";
      } else {
        $_SESSION['$admin'] = false;
        $admin = "false";
      }
    } else {
      $_SESSION['$uspjesnaPrijava'] = false;
    }
    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
    if ($_SESSION['$uspjesnaPrijava'] == true) {
      $unosLog = "Korisnik: $imeKorisnika\n\nAdmin: $admin";
      $query1 = "INSERT INTO logovi (radnja, nova_vrijednost)
      VALUES (?, ?)";
      $stmt1 = $pdo->prepare($query1);
      $stmt1->execute(["Prijava korisnika", $unosLog]);
    }
    if ($_SESSION['$uspjesnaPrijava'] == false) {
      ob_start();
      header('Location: index.php');
      ob_end_flush();
      die();
    }
  }
  if ($_SESSION['$username'] == "") {
    header("Location: index.php");
  }
  ?>

  <?php
  require "dijelovi_stranice/navigation_root.php";
  echo "$navigation1 $navigation2 $navigation3";
  ?>

  <a id="back2Top" title="Back to top" href="#">&#10148;</a>

  <div id="display"></div>

  <!-- <div class="upit">
    Želite li moći otvoriti više špranci odjednom?
    <input type="checkbox" id="check"><br>
    <div style="font-size: 10px;">Prije chekiranja/odchekiranja zatvorite sve otvorene šprance! :)</div>
  </div> -->

  <?php
  $sql2 = "SELECT u.id AS uid, u.naslov, u.tekst, u.id_kategorija, k.id, k.naziv
    FROM uvodi u
    JOIN kategorije k ON u.id_kategorija=k.id
    WHERE u.id=?";
  $kat = 31;
  $stmt = $pdo->prepare($sql2);
  $stmt->execute([$kat]);
  $stmt->bindColumn(1, $id1);
  $stmt->bindColumn(2, $naslov1);
  $stmt->bindColumn(3, $tekst1);
  $stmt->bindColumn(4, $uIdKategorija1);
  $stmt->bindColumn(5, $idKategorija1);
  $stmt->bindColumn(6, $nazivKategorije1);
  $stmt->fetch(PDO::FETCH_BOUND);
  ?>

  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-sm-8" id="first_info">
          <h1>
            <?php
            echo $naslov1;
            if ($_SESSION['$admin'] == true) {
              echo "
              <form method='POST' action='uvodi/edit.php'>
                <input type='hidden' name='id' value='" . $idKategorija1 . "'>
                <button name='edit' class='editbutton'><img src='img/pencil.svg' width='30px'></button>
              </form>
            ";
            }
            ?>
          </h1><br>
          <p>
            <?php echo nl2br($tekst1); ?>
          </p>
        </div>
        <div class="col-sm-4" id="second_info">
          <a href="sprance/popis.php">Popis špranci se nalazi ovdje.</a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <span id="warning">!</span>
            <strong>Uputa za nove agente u HD-u</strong> <br>
            Strogo se preporuča da se svaka špranca pročita s razumijevanjem te da se prilagodi ovisno o upitu.
          </div>
        </div>
      </div>
    </div>


  </div>

  <?php
  $sql = "SELECT s.id AS sid, s.naslov, s.tekst, s.id_kategorija, s.prioritet, k.id, k.naziv
    FROM sprance s
    JOIN kategorije k ON s.id_kategorija=k.id
    WHERE k.naziv='Početna'
    ORDER BY s.prioritet DESC";
  $stmt = $pdo->query($sql);
  ?>

  <div class="container-fluid">
    <div class="container" id="najcesci_upiti">
      <div class="row">
        <div class="col-sm-12">
          <h3>Najčešći upiti</h3>
          </br>
          <div class='accordion' id='accordionExample275'>
            <?php
            foreach ($stmt as $row) {
              echo "
                    <div class='card z-depth-0 bordered'>
                    <div class='card-header' id='heading" . $row['sid'] . "'>
                      <h5 class='mb-0'>
                        <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapse" . $row['sid'] . "'
                          aria-expanded='true' aria-controls='collapse" . $row['sid'] . "' id='card_selection'>" . $row['naslov'] . "</button>
                      </h5>";
              if ($_SESSION['$admin'] == true) {
                echo "
                    <form method='POST' action='sprance/prioriteti.php'>
                      <input type='number' class='prioritet' name='prioritet' value='" . $row['prioritet'] . "'>
                      <div class='prio'>" . $row['prioritet'] . "</div>
                      <input type='hidden' name='id' value='" . $row['sid'] . "'>
                    </form>
                    <form method='POST' action='sprance/edit.php'>
                      <input type='hidden' name='id' value='" . $row['sid'] . "'>
                      <button name='edit' class='editbutton'><img src='img/pencil.svg' width='30px'></button>
                    </form>
                    <form method='POST' action='sprance/delete.php' onclick='return ask()'>
                      <input type='hidden' name='id' value='" . $row['sid'] . "'>
                      <button name='del' class='delbutton' id='delbutton'><img src='img/smece.png' width='30px'></button>
                    </form>
                  ";
              }
              echo "</div>
                    <div id='collapse" . $row['sid'] . "' class='collapse' aria-labelledby='heading" . $row['sid'] . "'
                      data-parent='#accordionExample275'>
                      <div class='card-body'>";
              echo "<div>";
              echo nl2br($row['tekst']);
              echo "</div></div></div></div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <?php
    require "dijelovi_stranice/footer_root.php";
    echo $footer;
    ?>
  </footer>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    function ask() {
      let potvrda = confirm("Želite li stvarno obrisati odabranu šprancu?");
      if (potvrda == true) {
        return true;
      } else {
        return false;
      }
    }

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