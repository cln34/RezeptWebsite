<?php

$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
$passwort = isset($_SESSION["passwort"]) ? $_SESSION["passwort"] : "";
$passwortWDH = isset($_SESSION["passwortWDH"]) ? $_SESSION["passwortWDH"] : "";

// unset($_SESSION["email"]);
unset($_SESSION["passwort"]);
unset($_SESSION["passwortWDH"]);
?>

<?php
require_once "php/include/head.php";
?>

<body>
  <?php
  include_once "php/include/header.php";
  ?>

  <main class="anmeldung-main">

    <?php if (isset($_SESSION["message"]) && $_SESSION["message"] == "missing_required_parameters"): ?>
      <p>
        Fehler beim Aufruf der Seite: Es fehlen notwendige Parameter!
      </p>
    <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "passwords_do_not_match"): ?>
      <p>
        Die Passwörter stimmen nicht überein!
      </p>
    <?php endif; ?>

    <h1>Registrierung</h1>

    <form action="user-eintragen.php" method="post" class="anmeldung-form">
      <label for="email">E-Mail-Adresse</label>
      <input type="email" id="email" name="email" placeholder="z. B. max@mustermann.de" required />

      <label for="passwort">Passwort</label>
      <input type="password" id="passwort" name="passwort" placeholder="Passwort" minlength="8" maxlength="20" required />

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

  <script>
    const passwortFeld = document.getElementById("passwort");
    const wdhPasswortFeld = document.getElementById("passwortWDH");

    function validateWdhPasswortFeld() {
      const pwWDH = wdhPasswortFeld.value;
      const pw = passwortFeld.value;

      wdhPasswortFeld.classList.remove("input-valid", "input-invalid");

      if (pwWDH === "") {
        // Noch nichts eingegeben, keine Klasse setzen
        return;
      }
      if (pwWDH === pw) {
        wdhPasswortFeld.classList.add("input-valid");
      } else {
        wdhPasswortFeld.classList.add("input-invalid");
      }
    }

    passwortFeld.addEventListener("input", function() {
      const pw = this.value;
      this.classList.remove("input-valid", "input-invalid");

      if (pw.length < 8) {
        this.classList.add("input-invalid");
      } else {
        this.classList.add("input-valid");
      }

      // Wdh-Passwortfeld sofort mitprüfen!
      validateWdhPasswortFeld();
    });

    wdhPasswortFeld.addEventListener("input", validateWdhPasswortFeld);
  </script>
</body>

</html>