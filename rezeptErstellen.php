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

    <main class="rezeptErstellen">
        <form action="index.php">
            <h2>Rezept erstellen</h2>

            <label for="titel">Rezepttitel</label>
            <input type="text" id="titel" name="titel" required />

            <label for="bild">Bild hochladen</label>
            <input type="file" id="bild" name="bild" accept="image/*" />

            <label for="zutaten">Zutaten</label>
            <textarea id="zutaten" name="zutaten" rows="4" required></textarea>

            <label for="anleitung">Zubereitung</label>
            <textarea id="anleitung" name="anleitung" rows="6" required></textarea>

            <label for="beschreibung">Kurzbeschreibung</label>
            <textarea id="beschreibung" name="beschreibung" rows="3"></textarea>

            <label for="schwierigkeit">Schwierigkeit</label>
            <select id="schwierigkeit" name="schwierigkeit" required>
            <option value="leicht">leicht</option>
            <option value="mittel">mittel</option>
            <option value="schwer">schwer</option>
            </select>

            <label for="preis">Preis angeben (max 50€):</label>
            <input type="number" id="preis" name="preis" min="0" max="50" step="0.01" required />

            <input type="submit" value="Rezept speichern" />
        </form>
    </main>
  

    <?php
    include "php/footer.php"
    ?>

</body>

</html>