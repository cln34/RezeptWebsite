<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Rezeptesammlung">
  <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas">
  <link rel="stylesheet" href="css/main.css" />
  <title>StudiRezepte-Einfach & Günstig</title>
  <link href="https://fonts.googleapis.com/css2?family=Tagesschrift&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  include "header.php";
  ?>
  <hr />
  <main>
    <h1>StudiRezepte-Einfach & Günstig</h1>

    <form>
      <!--<label for="Suche">Neue Rezepte entdecken: </label>-->
      <div>
        <input type="text" id="Suche" name="Sucheingabe" placeholder="Neue Rezepte entdecken:" size="90" required>
        <input type="submit" value="suchen">
      </div> <!--name ist name für die eingegeben daten, eine variable sozusagen-->
    </form>
    <br>
    <hr />
    <h2>Rezepte:</h2>
    <!-- Flexbox erstellen, um essen nebeneinander darzustellen -->
    <div class="container">

      <!-- <a href="rezept.php" class="box-link"> -->
      <div class="box" id="box1">
        <h2>Pizza:</h2>
        <img
          src="images/pizza1.jpg"
          alt="das ist ein Bild von Pizza"
          title="Lecker Pizza" />
        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div>30 min</div>
          <div>Mittel</div>
          <div>4€</div>


        </div>
        <p>Kurzbeschreibung: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
      </div>
      <!--   </a> -->

      <div class="box" id="box2">
        <h2>Burger:</h2>
        <img
          src="images/burger.jpg"
          alt="das ist ein Bild von einem Burger"
          title="Saftiger Burger" />
        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div>20 min</div>
          <div>Leicht</div>
          <div>5€</div>
        </div>
        <p>Kurzbeschreibung: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
      </div>

      <div class="box" id="box3">
        <h2>Spaghetti Carbonara</h2>

        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>

      <div class="box" id="box4">
        <h2>Spaghetti Bolognese</h2>

        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>

      <div class="box" id="box4">
        <h2>Pesto</h2>

        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>

    </div>

  </main>
  <hr><br>
  <?php
  include "footer.php"
  ?>
</body>


</html>
<!--shift+alt+f zum formattieren-->