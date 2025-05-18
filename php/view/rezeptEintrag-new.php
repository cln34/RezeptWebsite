<?php

// Aufbereitung der Daten fuer die Ausgabe (View)
$titel = isset($_SESSION["titel"]) ? $_SESSION["titel"] : "";
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";

$kurzbeschreibung = isset($_SESSION["kurzbeschreibung"]) ? $_SESSION["kurzbeschreibung"] : ""; //prüfung ob es die veriable bereits gibt, wenn nein wird sie auf einen leeren string gesetzt
$dauer = isset($_SESSION["dauer"]) ? $_SESSION["dauer"] : "";
$schwierigkeit = isset($_SESSION["schwierigkeit"]) ? $_SESSION["schwierigkeit"] : "";
$preis = isset($_SESSION["preis"]) ? $_SESSION["preis"] : "";
$zutaten = isset($_SESSION["zutaten"]) ? $_SESSION["zutaten"] : "";
$anleitung = isset($_SESSION["anleitung"]) ? $_SESSION["anleitung"] : "";
$bild = isset($_SESSION["bild"]) ? $_SESSION["bild"] : "";

unset($_SESSION["titel"]);
unset($_SESSION["email"]);

unset($_SESSION["kurzbeschreibung"]);
unset($_SESSION["dauer"]);
unset($_SESSION["schwierigkeit"]);
unset($_SESSION["preis"]);
unset($_SESSION["zutaten"]);
unset($_SESSION["anleitung"]);
unset($_SESSION["bild"]);

//************************************************************************************
// TODO: Die variaben von oben mit werten belegen, damit man die createEntry funktion aufrufen kann
//************************************************************************************
?>



<?php
require_once "php/include/head.php";
?>

<body>

    <?php
    include_once "php/include/header.php";
    ?>

    <main class="rezeptErstellen">
        <form action="eintrag-eintragen.php" method="post">
            <h1>Rezept erstellen</h1>

            <label for="titel">Rezepttitel</label>
            <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($titel); ?>" required />

            <label for="bild">Bild hochladen</label>
            <input type="file" id="bild" name="bild" value="<?php echo htmlspecialchars($bild); ?>" accept="image/*" />

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
            <textarea id="anleitung" name="anleitung" rows="6" required><?php echo htmlspecialchars($anleitung); ?></textarea>

            <label for="kurzbeschreibung">Kurzbeschreibung</label>
            <textarea id="kurzbeschreibung" name="kurzbeschreibung" rows="3"><?php echo htmlspecialchars($kurzbeschreibung); ?></textarea>

            <label for="dauer">Dauer (in Minuten)</label>
            <input type="number" id="dauer" name="dauer" min="1" max="180" value="<?php echo htmlspecialchars($dauer); ?>" required />

            <label for="schwierigkeit">Schwierigkeit</label>
            <select id="schwierigkeit" name="schwierigkeit" required>
                <option value="" disabled <?= empty($schwierigkeit) ? 'selected' : '' ?>>-- Schwierigkeit wählen --</option>
                <option value="leicht" <?= $schwierigkeit == 'leicht' ? 'selected' : '' ?>>leicht</option>
                <option value="mittel" <?= $schwierigkeit == 'mittel' ? 'selected' : '' ?>>mittel</option>
                <option value="schwer" <?= $schwierigkeit == 'schwer' ? 'selected' : '' ?>>schwer</option>
            </select>

            <label for="preis">Preis angeben (max 50€):</label>
            <input type="number" id="preis" name="preis" min="0" max="50" step="1" value="<?php echo htmlspecialchars($preis); ?>" required />

            <input type="submit" value="Rezept speichern" />
        </form>
    </main>


    <?php
    include_once "php/include/footer.php"
    ?>

</body>

</html>