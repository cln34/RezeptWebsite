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
    include_once "php/header.php";
    ?>
    
    <main>
      <h1>Kommentare</h1>

      <div class="kommentar-container">
        <div class="kommentar-card">
          <h2>Colin <span class="kommentar-datum">(Datum einfügen)</span></h2>
          <div class="sterne-anzeige">★★★★☆</div>
          <p>Ich finde die Pizza müsste länger im Ofen sein, ansonsten sehr lecker.</p>
        </div>

        <div class="kommentar-card">
          <h2>Sascha <span class="kommentar-datum">(Datum einfügen)</span></h2>
          <div class="sterne-anzeige">★★★★★</div>
          <p>Einfach fabelhaft!</p>
        </div>

        <div class="kommentar-card">
          <h2>Chris <span class="kommentar-datum">(Datum einfügen)</span></h2>
          <div class="sterne-anzeige">★★★☆☆</div>
          <p>Da muss mehr Käse drauf!</p>
        </div>
      </div>

      <form action="" method="post" class="kommentar-form">
      <label for="bewertung">Bewertung:</label>
      <input type="text" id="bewertung" name="bewertung">
        <div class="sterne-bewertung">
        <fieldset class="sterne-bewertung">
          <legend>Bewertung abgeben</legend>
          <input type="radio" name="bewertung" id="stern5" value="5" required><label for="stern5">★</label>
          <input type="radio" name="bewertung" id="stern4" value="4"><label for="stern4">★</label>
          <input type="radio" name="bewertung" id="stern3" value="3"><label for="stern3">★</label>
          <input type="radio" name="bewertung" id="stern2" value="2"><label for="stern2">★</label>
          <input type="radio" name="bewertung" id="stern1" value="1"><label for="stern1">★</label>
        </fieldset>
        </div>

        <label for="kommentar" class="visually-hidden">Kommentar</label>
        <textarea id="kommentar" placeholder="Kommentar eingeben" name="Kommentar" required></textarea>
        <input type="submit" value="Kommentar absenden" class="button">
      </form>
    </main>
    
    <?php
    include_once "php/footer.php"
    ?>
</body>

</html>