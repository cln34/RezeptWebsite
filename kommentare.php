<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rezeptesammlung">
    <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas">
    <link rel="stylesheet" href="css/main.css" />
    <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
    <?php
    include "php/header.php";
    ?>
    <hr />
    <main>
      <h1>Kommentare</h1>

      <div class="kommentar-container">
        <div class="kommentar-card">
          <h3>Colin <span class="kommentar-datum">(Datum einfügen)</span></h3>
          <div class="sterne-anzeige">★★★★☆</div>
          <p>Ich finde die Pizza müsste länger im Ofen sein, ansonsten sehr lecker.</p>
        </div>

        <div class="kommentar-card">
          <h3>Sascha <span class="kommentar-datum">(Datum einfügen)</span></h3>
          <div class="sterne-anzeige">★★★★★</div>
          <p>Einfach fabelhaft!</p>
        </div>

        <div class="kommentar-card">
          <h3>Chris <span class="kommentar-datum">(Datum einfügen)</span></h3>
          <div class="sterne-anzeige">★★★☆☆</div>
          <p>Da muss mehr Käse drauf!</p>
        </div>
      </div>

      <form action="" method="post" class="kommentar-form">
        <label for="bewertung">Bewertung:</label>
        <div class="sterne-bewertung">
          <input type="radio" name="bewertung" id="stern5" value="5" required><label for="stern5">★</label>
          <input type="radio" name="bewertung" id="stern4" value="4"><label for="stern4">★</label>
          <input type="radio" name="bewertung" id="stern3" value="3"><label for="stern3">★</label>
          <input type="radio" name="bewertung" id="stern2" value="2"><label for="stern2">★</label>
          <input type="radio" name="bewertung" id="stern1" value="1"><label for="stern1">★</label>
        </div>

        <textarea placeholder="Kommentar eingeben" name="Kommentar" required></textarea>
        <input type="submit" value="Kommentar absenden" class="button">
      </form>
    </main>
    <hr><br>
    <?php
    include "php/footer.php"
    ?>
</body>

</html>