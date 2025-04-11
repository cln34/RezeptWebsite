<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="Rezeptesammlung" />
    <meta
      name="author"
      content="Sascha Busse, Christoph Rettig, Colin Bolbas"
    />
    <link rel="stylesheet" href="css/main.css" />
    <title>StudiRezepte-Einfach & Günstig</title>
  </head>

  <body>
   <?php
include "header.php";
?>

    <main>
      <h1>Registrierung</h1>
      <form>
        <div>
          <input type="text" placeholder="Email Adresse" id="email" />
        </div>
        <br />
        <div>
          <input type="text" placeholder="Passwort" id="passwort" />
        </div>
        <br />
        <div>
          <input
            type="text"
            placeholder="Passwort wiederholen"
            id="passwortWDH"
          />
        </div>
        <br />
      </form>
      <a href="anmeldung.php">
            <input type="submit"></a>
    </main>

       <?php
include "footer.php"
?>
  </body>
</html>
