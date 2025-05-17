<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if (isset($_SESSION["email"])) {
  echo $_SESSION["email"];
}
?>

<?php
require_once "php/include/head.php";
?>

<body>
  <?php
  include_once "php/include/header.php";
  ?>

  <main class="rezept-container">
    <h1>Rezept</h1>
    <h2>Pizza</h2>
    <img src="images/pizza.jpg" alt="Das ist ein Bild von Pizza" title="Lecker Pizza" class="rezept-bild" />

    <div class="table-container">
      <div class="table-header">
        <div>Dauer</div>
        <div>Schwierigkeit</div>
        <div>Ungefährer Preis</div>
      </div>
      <div class="table-row">
        <div>30 min</div>
        <div>Mittel</div>
        <div>4€</div>
      </div>
    </div>

    <div class="table-container">
      <div class="table-header">
        <div>Zutat</div>
        <div>Menge</div>
      </div>
      <div class="table-row">
        <div>Weizenmehl</div>
        <div>500g</div>
      </div>
      <div class="table-row">
        <div>Wasser</div>
        <div>250ml</div>
      </div>
      <div class="table-row">
        <div>Hefe</div>
        <div>1 Würfel</div>
      </div>
      <div class="table-row">
        <div>Tomatensauce</div>
        <div>200g</div>
      </div>
      <div class="table-row">
        <div>Mozzarella</div>
        <div>100g</div>
      </div>
      <div class="table-row">
        <div>Belag</div>
        <div>nach Belieben</div>
      </div>
      <div class="table-row">
        <div>Basilikum</div>
        <div></div>
      </div>
    </div>

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

    <a href="kommentare.php" class="rezept-button">Kommentare ansehen </a>

  </main>

  <?php
  include_once "php/include/footer.php"
  ?>
</body>

</html>
