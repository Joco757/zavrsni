<?php
$navigation1 = "<nav class='navbar navbar-expand-md bg-dark navbar-dark sticky-top' id='navbar_bg'>
<a class='navbar-brand' href='../home.php'>CARNET Helpdesk </a>
<ul class='navbar-nav mr-auto'>

  <li class='nav-item dropdown dmenu'>
    <a class='nav-link dropdown-toggle' id='navbardrop' data-toggle='dropdown' href='#/'>DNS</a>
    <div class='dropdown-menu sm-menu'>
      <a class='dropdown-item' href='../kategorija.php?id=1'>Najčešći upiti</a>
      <a class='dropdown-item' href='../kategorija.php?id=2'>from.hr</a>
      <a class='dropdown-item' href='../kategorija.php?id=3'>Hosting</a>
      <a class='dropdown-item' href='../kategorija.php?id=4'>Ažuriranje podataka</a>
      <a class='dropdown-item' href='../kategorija.php?id=5'>Ostalo</a>
    </div>
  </li>

  <li class='nav-item dropdown dmenu'>
    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>HUSO</a>
    <div class='dropdown-menu sm-menu'>
      <a class='dropdown-item' href='../kategorija.php?id=6'>Najčešći upiti</a>
      <a class='dropdown-item' href='../kategorija.php?id=7'>Ažuriranje korisnika</a>
      <a class='dropdown-item' href='../kategorija.php?id=8'>AAI@Edu.hr</a>
      <a class='dropdown-item' href='../kategorija.php?id=9'>Ostalo</a>
    </div>
  </li>

  <li class='nav-item dropdown dmenu'>
    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>Udaljeno učenje</a>
    <div class='dropdown-menu sm-menu'>
      <a class='dropdown-item' href='../kategorija.php?id=10'>Najčešći upiti</a>
      <a class='dropdown-item' href='../kategorija.php?id=11'>Office365</a>
      <a class='dropdown-item' href='../kategorija.php?id=12'>Google Workspace</a>
      <a class='dropdown-item' href='../kategorija.php?id=13'>Ostalo</a>
    </div>
  </li>

  <li class='nav-item dropdown dmenu'>
    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>Odabir udžbenika</a>
    <div class='dropdown-menu sm-menu'>
      <a class='dropdown-item' href='../kategorija.php?id=14'>Najčešći upiti</a>
      <a class='dropdown-item' href='../kategorija.php?id=15'>Faza 1</a>
      <a class='dropdown-item' href='../kategorija.php?id=16'>Faza 2</a>
      <a class='dropdown-item' href='../kategorija.php?id=17'>Faza 3</a>
    </div>
  </li>

  <li class='nav-item dropdown dmenu'>
    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>Webmail</a>
    <div class='dropdown-menu sm-menu'>
      <a class='dropdown-item' href='../kategorija.php?id=18'>Najčešći upiti</a>
      <a class='dropdown-item' href='../kategorija.php?id=19'>Office365 / Google Workspace</a>
      <a class='dropdown-item' href='../kategorija.php?id=20'>Ostalo</a>
    </div>
  </li>

  <li class='nav-item dropdown dmenu'>
    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>Ostalo</a>
    <div class='dropdown-menu sm-menu'>
      <a class='dropdown-item' href='../kategorija.php?id=21'>Postani student</a>
      <a class='dropdown-item' href='../kategorija.php?id=22'>MSDC</a>
      <a class='dropdown-item' href='../kategorija.php?id=23'>Filtriranje</a>
      <a class='dropdown-item' href='../kategorija.php?id=24'>Javni poslužitelj</a>
      <a class='dropdown-item' href='../kategorija.php?id=25'>Probni esej</a>
      <a class='dropdown-item' href='../kategorija.php?id=26'>Kontakt adrese</a>
      <a class='dropdown-item' href='../kategorija.php?id=27'>Kontakt brojevi</a>
      <a class='dropdown-item' href='../kategorija.php?id=28'>Potpisi</a>
      <a class='dropdown-item' href='../kategorija.php?id=29'>Ostalo</a>
    </div>
  </li>

  <li class='nav-item'>
    <a class='nav-link' href='../kategorija.php?id=30'>RT</a>
  </li>

</ul>

<ul class='nav navbar-nav navbar-right'>";

if ($_SESSION['$admin'] == true) {
    $navigation2 = "<li class='nav-item dropdown dmenu admin'>
        <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>Admin</a>
        <div class='dropdown-menu sm-menu'>
            <a href='../sprance/novo.php' class='dropdown-item'>Dodaj šprancu</a>
            <a href='../administracija/logs.php' class='dropdown-item'>Logovi</a>
        </div>
        </li>";
}

$navigation3 = "<form class='form-inline my-2 my-lg-0' method='POST' action='../search/search.php'>
<span id='errKlj' hidden></span>
<input class='form-control mr-sm-2' type='search' name='kljRijec' id='kljRijec' placeholder='Upišite ključnu riječ' aria-label='Search' autocomplete='off'>
<button class='btn btn-success my-2 my-sm-0' type='submit' name='search' id='search'>Search</button>
</form>
<li><a href='#/'><img src='../img/crescent.svg' height='25px' id='theme-toggle' title='Promjena teme'></a></li>
<li><a href='../administracija/odjava.php' class='nav-link'>Odjava</a></li>
</ul>
</nav>";

?>