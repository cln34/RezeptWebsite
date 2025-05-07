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

    <main class="rezeptErstellen">
        <form action="index.php">
            <h1>Rezept erstellen</h1>

            <label for="titel">Rezepttitel</label>
            <input type="text" id="titel" name="titel" required />

            <label for="bild">Bild hochladen</label>
            <input type="file" id="bild" name="bild" accept="image/*" />

            <label for="zutaten">Zutaten</label>
            <div id="zutaten-container">
                <div class="zutat-eintrag">
                    <select id="zutaten" name="zutaten[]" required>
                        <option value="" disabled selected>-- Zutat wählen --</option>
                        <option value="Mehl">Mehl</option>
                        <option value="Zucker">Zucker</option>
                        <option value="Eier">Eier</option>
                        <option value="Milch">Milch</option>
                        <option value="Butter">Butter</option>
                        <option value="Salz">Salz</option>
                        <option value="Pfeffer">Pfeffer</option>
                        <option value="Olivenöl">Olivenöl</option>
                        <option value="Sahne">Sahne</option>
                        <option value="Hefe">Hefe</option>
                        <option value="Backpulver">Backpulver</option>
                        <option value="Vanillezucker">Vanillezucker</option>
                        <option value="Zimt">Zimt</option>
                        <!-- Weitere Zutaten hier -->
                    </select>
                    <label for="menge" class="visually-hidden">Menge</label> <!-- Unsichtbares Label für Barrierefreiheit -->
                    <input type="text" id=menge name="mengen[]" placeholder="Menge (z. B. 200g)" required>
                </div>
            </div>

            <!-- Button zum Hinzufügen einer weiteren Zutat -->
            <!-- Funktion addZutat() später bei JavaScript einfügen-->
            <button type="button" onclick="addZutat()">Weitere Zutat hinzufügen</button>

            <label for="anleitung">Zubereitung</label>
            <textarea id="anleitung" name="anleitung" rows="6" required></textarea>

            <label for="beschreibung">Kurzbeschreibung</label>
            <textarea id="beschreibung" name="beschreibung" rows="3"></textarea>

            <label for="dauer">Dauer (in Minuten)</label>
            <input type="number" id="dauer" name="dauer" min="1" max="180" required />

            <label for="schwierigkeit">Schwierigkeit</label>
            <select id="schwierigkeit" name="schwierigkeit" required>
            <option value="" disabled selected>-- Schwierigkeit wählen --</option>
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
    include_once "php/footer.php"
    ?>

</body>

</html>