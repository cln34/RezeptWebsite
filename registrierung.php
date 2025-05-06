<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Rezeptesammlung" />
  <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas" />
  <link rel="stylesheet" href="css/main.css" />
  <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
  <?php
  include_once "php/header.php";
  ?>
<hr>
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
<hr><br>
  <?php
  include_once "php/footer.php"
  ?>
</body>

</html>