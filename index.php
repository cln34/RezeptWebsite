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
    oder:
    <a href="rezeptErstellen.php">
      <button>Rezept erstellen</button></a>
    <hr />
    <h2>Rezepte:</h2>
    <!-- Flexbox erstellen, um essen nebeneinander darzustellen -->
    <div class="container">
      <div class="box" id="box1">Pizza</div>
      <div class="box" id="box2">Burger</div>
      <div class="box" id="box3">Spaghetti Carbonara</div>
      <div class="box" id="box4">Spaghetti Bolognese</div>
      <div class="box" id="box4">Pesto</div>
    </div>



  </main>
  <hr><br>
  <?php
  include "footer.php"
  ?>
</body>


</html>
<!--shift+alt+f zum formattieren-->