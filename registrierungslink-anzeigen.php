<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <title>Simulierte E-Mail</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f4f4f4;
      padding: 2rem;
    }

    .container {
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 2rem;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    a.button,
    button {
      display: inline-block;
      padding: 0.6rem 1.2rem;
      margin-top: 1rem;
      font-size: 1rem;
      background-color: #0077cc;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button.dummy {
      background-color: gray;
      cursor: not-allowed;
    }

    p {
      line-height: 1.6;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Simulierte E-Mail</h2>

    <p>Hallo,</p>

    <p>
      Bitte ignoriere diese Nachricht, falls du dich nicht registrieren wolltest.
    </p>

    <p>
      Falls du dich registrieren möchtest und diese E-Mail erwartest, klicke bitte auf den folgenden Link, um deine Registrierung abzuschließen:
    </p>
    <a href="registrierung-bestaetigen.php" class="button">➡️ Registrierung abschließen</a>

    <p>
      Falls du bereits registriert bist und diese Anfrage nicht gestellt hast, ändere bitte dein Passwort, um dein Konto zu sichern. Klicke dazu auf den folgenden Button:
    </p>
    <button class="dummy" disabled>🔐 Passwort zurücksetzen</button>

    <p style="margin-top: 2rem;">
      Viele Grüße<br>
      Dein RezeptWebsite-Team
    </p>
  </div>
</body>

</html>