<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Rezeptesammlung" />
  <meta
    name="author"
    content="Sascha Busse, Christoph Rettig, Colin Bolbas" />
  <link rel="stylesheet" href="css/main.css" />
  <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
  <?php
  include "php/header.php";
  ?>
  <hr>
  <main class="rezept-container">
  <h1>Rezept:</h1>
  <h2>Pizza</h2>
  <img src="images/pizza.jpg" alt="Das ist ein Bild von Pizza" title="Lecker Pizza" class="rezept-bild" />

  <table class="rezept-info-table">
    <tr>
      <th>Dauer</th>
      <th>Schwierigkeit</th>
      <th>Ungefährer Preis</th>
    </tr>
    <tr>
      <td>30 min</td>
      <td>Mittel</td>
      <td>4€</td>
    </tr>
  </table>

  <h2>Zutaten</h2>
<table class="zutaten-table">
  <thead>
    <tr>
      <th>Zutat</th>
      <th>Menge</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Weizenmehl</td>
      <td>500g</td>
    </tr>
    <tr>
      <td>Wasser</td>
      <td>250ml</td>
    </tr>
    <tr>
      <td>Hefe</td>
      <td>1 Würfel</td>
    </tr>
    <tr>
      <td>Tomatensauce</td>
      <td>200g</td>
    </tr>
    <tr>
      <td>Mozzarella</td>
      <td>100g</td>
    </tr>
    <tr>
      <td>Belag</td>
      <td>nach Belieben</td>
    </tr>
    <tr>
      <td>Basilikum</td>
      <td></td>
    </tr>
  </tbody>
</table>

  <div class="rezept-schritt">
    <h3>1. Schritt</h3>
    <p>250ml lauwarmes Wasser in einen Messbecher füllen. Hefe hineinbröseln und mit einer Prise Zucker und Salz verrühren. 10-15 Minuten gehen lassen.</p>
  </div>

  <div class="rezept-schritt">
    <h3>2. Schritt</h3>
    <p>Das Mehl und Salz in eine Schüssel geben. Flüssigkeit und Öl über das Mehl geben und mit den Knethaken des Handrührgeräts mindestens 5 Minuten kneten (von Hand mindestens 10 Minuten). Danach mit den Händen geschmeidig kneten. Teigschüssel abdecken und an warmem Ort ca. 40 Minuten gehen lassen.</p>
  </div>

  <div class="rezept-schritt">
    <h3>3. Schritt</h3>
    <p>Teig halbieren und auf bemehlter Fläche rund ausrollen. Ofen auf 240°C vorheizen. Teig auf Backpapier legen und belegen. Ca. 15 Minuten backen.</p>
  </div>

  <a href="kommentare.php">
    <button class="rezept-button">Kommentare ansehen</button>
  </a>
</main>
  <hr><br>
  <?php
  include "php/footer.php"
  ?>
</body>

</html>