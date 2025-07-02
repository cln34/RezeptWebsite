<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    !isset($_POST["email"]) ||
    !isset($_POST["passwort"]) ||
    !isset($_POST["passwortWDH"]) ||
    !isset($_POST["datenschutz"]) ||
    !isset($_POST["nutzungsbedingungen"])
) {
    echo "Fehlende Eingaben oder Zustimmung.";
    exit;
}

$email = trim($_POST["email"]);
$passwort = $_POST["passwort"];
$passwortWDH = $_POST["passwortWDH"];

if ($passwort !== $passwortWDH) {
    echo "Passwörter stimmen nicht überein.";
    exit;
}

$_SESSION["pending_email"] = $email;
$_SESSION["pending_passwort"] = $passwort;

require_once "php/include/head.php";
?>

<body>
  <?php include "php/include/header.php"; ?>

  <main class="anmeldung-main">
    <h2>Fast fertig!</h2>
    <p>Bitte klicken Sie auf den folgenden Button, um die Registrierung abzuschließen:</p>

    <form action="registrierung-bestaetigen.php" method="post">
      <button type="submit">Registrierung bestätigen</button>
    </form>
  </main>
</body>
</html>
