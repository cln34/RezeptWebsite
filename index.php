<?php
session_start();
if (isset($_SESSION["email"])) {
  echo $_SESSION["email"];
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Rezeptesammlung">
  <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas">
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
  <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
  <?php
  include_once "php/header.php";
  ?>

  <main>
    <h1>StudiRezepte-Einfach & Günstig</h1>

    <section class="search-container">
      <form action="">
        <div class="search">
          <label for="Suche" class="visually-hidden">Suche</label> <!-- Unsichtbares Label für Barrierefreiheit -->
          <span class="search-icon material-symbols-outlined"> search </span>
          <input class="search-input" type="search" id="Suche" name="Sucheingabe" placeholder="Neue Rezepte entdecken:" size="90" required>
        </div> <!--name ist name für die eingegeben daten, eine variable sozusagen-->
      </form>
    </section>

    <!-- Flexbox erstellen, um essen nebeneinander darzustellen -->
    <section class="flexcontainer">

      <div class="flexbox" id="box1">
        <h2>Pizza:</h2>
        <a href="rezept.php" class="box-link">
          <img
            src="images/pizza.jpg"
            alt="Das ist ein Bild von Pizza"
            title="Lecker Pizza" />
        </a>
        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div>30 min</div>
          <div>Mittel</div>
          <div>4€</div>

        </div>
        <p>Kurzbeschreibung: odit alias magnam rem rerum a Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos consequuntur delectus nostrum sit at quam libero! Libero odio temporibus aspernatur, eveniet nostrum error voluptatibus unde dolorum id repudiandae non quasi? t? Repellat ad odio deleniti dolore quibusdam molestiae, optio placeat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
      </div>

      <div class="flexbox" id="box2">
        <h2>Burger:</h2>
        <img
          src="images/burger.jpg"
          alt="Das ist ein Bild von einem Burger"
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

      <div class="flexbox" id="box3">
        <h2>Spaghetti Carbonara</h2>
        <img
          src="images/carbonara.jpg"
          alt="das ist ein Bild von Spaghetti Carbonara"
          title="Spaghetti Carbonara" />
        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div>30 min</div>
          <div>Schwer</div>
          <div>7€</div>
        </div>
        <p>Kurzbeschreibung: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
      </div>

      <div class="flexbox" id="box4">
        <h2>Spaghetti Bolognese</h2>
        <img
          src="images/Bolognese.jpg"
          alt="Das ist ein Bild von Spaghetti Bolognese"
          title="Spaghetti Bolognese" />
        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div>35 min</div>
          <div>Mittel</div>
          <div>5€</div>
        </div>
        <p>Kurzbeschreibung: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
      </div>

      <div class="flexbox" id="box5">
        <h2>Pesto</h2>
        <img
          src="images/Pesto.jpg"
          alt="Das ist ein Bild von Pesto"
          title="Pesto" />
        <div class="info-grid">
          <div>Dauer</div>
          <div>Schwierigkeit</div>
          <div>Ungefährer Preis</div>
          <div>15 min</div>
          <div>Einfach</div>
          <div>6€</div>
        </div>
        <p>Kurzbeschreibung: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
      </div>

    </section>

  </main>

  <?php
  include_once "php/footer.php"
  ?>
</body>


</html>
<!--shift+alt+f zum formattieren-->