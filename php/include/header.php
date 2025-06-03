<header class="header">
  <nav class="navbar">
    <ul class="left-links">
      <li><a href="index.php">Homepage</a></li>
      <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
        <li><a href="rezeptErstellen.php">Rezept erstellen</a></li>
        <li><a href="favoriten.php">Favoriten</a></li>
        <?php if (isset($_SESSION["rolle"]) && $_SESSION["rolle"] === "Admin") { ?>
          <li><a href="userliste.php">Userliste</a></li>
        <?php } ?>
      <?php } ?>
    </ul>

    <ul class="right-buttons">
      <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) { ?>
        <li><a href="abmeldung.php" class="button-link">Abmelden</a></li>
      <?php } else { ?>
        <li><a href="anmeldung.php" class="button-link">Anmelden</a></li>
        <li><a href="registrierung.php" class="button-link">Registrieren</a></li>
      <?php } ?>

    </ul>
  </nav>
</header>