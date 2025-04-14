<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Rezeptesammlung">
  <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas">
  <link rel="stylesheet" href="css/main.css" />
  <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
  <?php
  include "header.php";
  ?>
  <hr />
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
  beispielausgabe!!!!:
  <!-- Tabelle erstellen, um essen nebeneinander darzustellen -->
  <table width="100%">
    <tr>
      <!-- erste zzelle für Pizza -->
      <td width="50%" valign="top">
        <h2>Pizza:</h2>
        <a href="rezept.php">
          <img
            src="images/pizza1.jpg"
            alt="das ist ein Bild von Pizza"
            title="Lecker Pizza"
            height="300" />
        </a>
        <table width="100%" bgcolor="black">
          <tr bgcolor="grey" align="center">
            <th width="150">Dauer</th>
            <th width="150">Schwierigkeit</th>
            <th width="150">Ungefährer Preis</th>
          </tr>
          <tr bgcolor="lightgrey" align="center">
            <td>30 min</td>
            <td>Mittel</td>
            <td>4€</td>
          </tr>
        </table>
        Kurzbeschreibung hier hinschreiben
      </td>

      <!-- zweite zelle für Burger -->
      <td width="50%" valign="top">
        <h2>Burger:</h2>

        <img
          src="images/burger.jpg"
          alt="das ist ein Bild von einem Burger"
          title="Saftiger Burger"
          height="300" />
        <table width="100%" bgcolor="black">
          <tr bgcolor="grey" align="center">
            <th width="150">Dauer</th>
            <th width="150">Schwierigkeit</th>
            <th width="150">Ungefährer Preis</th>
          </tr>
          <tr bgcolor="lightgrey" align="center">
            <td>20 min</td>
            <td>Einfach</td>
            <td>5€</td>
          </tr>
        </table>
        Kurzbeschreibung hier hinschreiben
      </td>
    </tr>
    <tr>
      <td>
        <h2>Spaghetti Carbonara</h2>
        <p>hier noch bild einfügem</p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur tenetur voluptates corrupti dignissimos dicta perferendis quisquam sequi. Eos, repudiandae itaque praesentium error, aperiam maxime assumenda deserunt voluptatem autem nulla sint.
      </td>
      <td>
        <h2>Spaghetti Bolognese</h2>
        <p>hier noch bild einfügem</p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, magni neque ratione ad nam quis dolorem aliquam modi tenetur porro recusandae temporibus itaque excepturi facilis aspernatur explicabo, numquam tempore eum!
      </td>

    </tr>
  </table>

</body>
<hr><br>
<?php
include "footer.php"
?>

</html>
<!--shift+alt+f zum formattieren-->