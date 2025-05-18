<?php
require_once 'php/dummyUser.php'; //Dummy-Datenbank mit Benutzern
if ($_SERVER["REQUEST_METHOD"] === "POST") { //bedeutung: wenn dieses skript durch ein post anfrage aufgerufen wurde, führe folgenden code aus ($_SERVER ist ein spezielles PHP-Array, das Infos über die aktuelle Serveranfrage enthält.)
  $email = $_POST["email"];
  $password = $_POST["passwort"];  //variablen setzen aus den eingegeben daten

  if (isset($users[$email]) && password_verify($password, $users[$email])) { //schaut ob es im users array einen eintrag mit der eingegebenen email gibt und vergleicht dann die (gehashten) passwörter
    session_start();
    $_SESSION["email"] = $email; //setzt die session variable email auf die eingegebene email
    $_SESSION["loggedin"] = true; //setzt die session variable loggedin auf true, später damit man auf abmeldung seite kommt
    header("Location: index.php"); //leitet auf die index.php weiter
    echo "Sie sind angemeldet";
    exit(); //code wird hier abgebrochen
  } else {
    echo "Falsche Daten eingegeben!";
  }
}
?>

<?php
require_once "php/include/head.php";
?>

<body>
  <?php include_once "php/include/header.php"; ?>
  <main class="anmeldung-main">
    <h1>Anmeldung</h1>

    <form action="anmeldung.php" method="post" class="anmeldung-form">
      <label for="email">E-Mail-Adresse</label>
      <input type="email" id="email" name="email" placeholder="z. B. max@mustermann.de" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />

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
