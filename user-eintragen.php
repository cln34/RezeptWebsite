<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Eingaben prüfen
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

// Daten für spätere Registrierung speichern
$_SESSION["pending_email"] = $email;
$_SESSION["pending_passwort"] = $passwort;

// E-Mail simulieren in email.txt
$emailDatei = "email.txt";
$datei = fopen($emailDatei, "w");

$text = "Hallo,\n\n";
$text .= "Bitte ignoriere diese Nachricht, falls du dich nicht registrieren wolltest.\n\n";
$text .= "➡️ Falls du dich registrieren möchtest, klicke hier:\n";
$text .= "registrierungslink-anzeigen.php\n\n";
$text .= "➡️ Falls du dein Passwort vergessen hast, klicke auf den Dummy-Button in der Anzeige.\n\n";
$text .= "Viele Grüße\nDein RezeptWebsite-Team";

fwrite($datei, $text);
fclose($datei);

// Seitenaufbau
require_once "php/include/head.php";
?>

<body>
  <?php include "php/include/header.php"; ?>

  <main class="anmeldung-main">
    <h2>Fast fertig!</h2>
    <p>Wir haben Ihre Registrierungsanfrage erhalten.</p>
    <p>Weitere Informationen finden Sie in der <a href="registrierungslink-anzeigen.php" target="_blank">simulierten E-Mail</a>.</p>
  </main>
</body>
</html>
