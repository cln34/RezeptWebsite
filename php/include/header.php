<header class="header">
  <nav class="navbar">
    <ul class="left-links">
      <li><a href="index.php">Homepage</a></li>
      <li><a href="favoriten.php">Favoriten</a></li>
      <li><a href="rezeptErstellen.php">Rezept erstellen</a></li>
      <li><a href="userliste.php">Userliste</a></li>
    </ul>

    <ul class="right-buttons">
      <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) { ?>
        <li><a href="abmeldung.php" class="button-link">Abmelden</a></li>
      <?php } else { ?>
        <li><a href="anmeldung.php" class="button-link">Anmelden</a></li>
      <?php } ?>
      <li><a href="registrierung.php" class="button-link">Registrieren</a></li>
    </ul>
  </nav>
</header>