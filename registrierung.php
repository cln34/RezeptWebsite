<?php
require_once "php/include/head.php";
?>

<body>
  <?php
  include_once "php/include/header.php";
  ?>

  <main class="anmeldung-main">
    <h1>Registrierung</h1>

    <form action="registrieren.php" method="post" class="anmeldung-form">
      <label for="email">E-Mail-Adresse</label>
      <input type="email" id="email" name="email" placeholder="z. B. max@mustermann.de" required />

      <label for="passwort">Passwort</label>
      <input type="password" id="passwort" name="passwort" placeholder="Passwort" required />

      <label for="passwortWDH">Passwort wiederholen</label>
      <input type="password" id="passwortWDH" name="passwortWDH" placeholder="Passwort wiederholen" required />

      <input type="submit" value="Registrieren" class="button" />
    </form>

    <p class="centered-link">
      <a href="anmeldung.php">Bereits registriert? Jetzt anmelden</a>
    </p>
  </main>

  <?php
  include_once "php/include/footer.php"
  ?>
</body>

</html>
