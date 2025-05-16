
<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Passwort vergessen</title>
  <link rel="stylesheet" href="css/main.css" />
</head>

<body>
  <?php include_once "php/include/header.php"; ?>
  <main class="anmeldung-main">
    <h1>Passwort vergessen</h1>


    <!-- Hier wird das Formular für die Passwort-Wiederherstellung angezeigt -->
    <p>Gib bitte deine E-Mail-Adresse ein, um einen Link zum Zurücksetzen deines Passworts zu erhalten.</p>
    <form action="passwort-zuruecksetzen.php" method="post" class="anmeldung-form">
      <label for="email">E-Mail-Adresse</label>
      <input type="email" id="email" name="email" placeholder="z. B. max@mustermann.de" required />

      <input type="submit" value="Link zum Zurücksetzen senden" class="button" />
    </form>

    <p class="centered-link">
      <a href="anmeldung.php">Zurück zur Anmeldung</a>
    </p>
  </main>
  <?php include_once "php/include/footer.php"; ?>
</body>

</html>