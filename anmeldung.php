<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anmeldung</title>
  <link rel="stylesheet" href="css/main.css" />
</head>

<body>
  <?php include_once "php/header.php"; ?>
  <main class="anmeldung-main">
    <h1>Anmeldung</h1>

    <form action="login.php" method="post" class="anmeldung-form">
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
  <?php include_once "php/footer.php"; ?>
</body>
</html>