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
    <br>
    <h1>Rezept erstellen</h1>
    <hr>
    <br>
    <form >
        <div>
         <label>Rezepttitel eingeben: <input type="text" placeholder="Rezepttitel"></label>
        </div>
        <br>
         <div>
         <label>Bild einfügen:   <input type="file" placeholder="Bild einfügen"></label>
        </div>
        <br>
         <div>
         <label>Rezepttitel eingeben: <input type="text" placeholder="Rezepttitel eingeben"></label>
        </div>
        <br>
         <div>
         <label>Kochanleitung eingeben: <input type="text" placeholder="Kochanleitung"></label>
        </div>
        <br>
         <div>
         <label>Kurzbeschreibung eingeben: <input type="text" placeholder="Kurzbeschreibung"></label>
        </div>
        
    </form>

    <?php
    include "footer.php"
    ?>
</body>
</html>