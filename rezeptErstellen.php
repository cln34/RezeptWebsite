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
    include "php/header.php";
    ?>
    <hr>
    <br>
    <main>
        <h1>Rezept erstellen</h1>
        <hr>
        <br>
        <form>
            <p>Rezeptitel eingeben:</p>
            <div>
                <label for="Rezepttitel"><input type="text" placeholder="Rezepttitel" name="Rezepttitel" required></label>
            </div>
            <br>
            <hr>
            <p>Bild einfügen:</p>
            <div>
                <label for="Bild"><input type="file" placeholder="Bild einfügen" name="Bild" required></label>
            </div>
            <br>
            <hr>
            <p>Zutaten eingeben: </p>
            <div>
                <label for="Zutaten"><textarea placeholder="Zutaten" name="Zutaten" required></textarea></label>
            </div>
            <br>
            <hr>
            <p>Kochanleitung eingeben:</p>
            <div>
                <label for="Kochanleitung"><textarea placeholder="Kochanleitung" name="Kochanleitung" required></textarea></label>
            </div>
            <br>
            <hr>
            <p>Kurzbeschreibung eingeben:</p>
            <div>
                <label for="Kurzbeschreibung"><textarea placeholder="Kurzbeschreibung" name="Kurzbeschreibung" required></textarea></label>
            </div>
            <br>
            <hr>
            <p>Schwierigkeit angeben: </p>
            <div>
                <label for="Schwierigkeit"><select placeholder="Schwierigkeit" name="Schwierigkeit" required>
                        <option value="leicht">leicht</option>
                        <option value="mittel">mittel</option>
                        <option value="schwer">schwer</option>
                    </select>

                </label>
            </div>
            <br>
            <hr>
            <p>Preis angeben (max 50€):</p>
            <div>
                <label for="Preis"><input type="number" placeholder="Preis" name="Preis" required max="50" min="0"></textarea></label>
            </div>
            <br>
            <hr>
            <input type="submit">

        </form>
    </main>
    <hr><br>
    <?php
    include "php/footer.php"
    ?>
</body>

</html>