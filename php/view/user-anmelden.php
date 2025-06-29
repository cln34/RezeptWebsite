<?php

$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
$passwort = isset($_SESSION["passwort"]) ? $_SESSION["passwort"] : "";
unset($_SESSION["email"]);
unset($_SESSION["passwort"]);
?>

<?php
require_once "php/include/head.php";
?>

<body>
  <?php include_once "php/include/header.php"; ?>
  <main class="anmeldung-main">

    <?php if (isset($_SESSION["message"]) && $_SESSION["message"] == "invalid_entry_id"): ?>
            <p>
                Das Rezept kann leider nicht gefunden werden.
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "internal_error"): ?>
            <p>
                Es ist ein interner Fehler aufgetreten.
                Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "missing_required_parameters"): ?>
            <p>
                Fehler beim Aufruf der Seite: Es fehlen notwendige Parameter!
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "new_login"): ?>
            <p>
                Neuer Eintrag wurde hinzugefügt!
            </p>
    <?php endif; ?>

    <h1>Anmeldung</h1>

    <form action="user-anmelden.php" method="post" class="anmeldung-form">
      <label for="email">E-Mail-Adresse</label>
      <input type="email" id="email" name="email" placeholder="z. B. max@mustermann.de" required />

      <label for="passwort">Passwort</label>
      <input type="password" id="passwort" name="passwort" placeholder="Passwort" required />

      <input type="submit" value="Anmelden" class="button" />
    </form>

    <p class="centered-link">
      <a href="registrierung.php">Noch kein Konto? Jetzt registrieren</a><br />
      <a href="passwort-vergessen.php">Passwort vergessen?</a>
    </p>
  </main>
  <?php include_once "php/include/footer.php"; ?>
</body>

</html>