<?php
require_once "php/include/head.php";
?>

<body>
    <?php include_once "php/include/header.php"; ?>

    <main class="rezeptErstellen">
        <form action="eintrag-aktualisieren.php" method="post">
            <h1>Rezept bearbeiten</h1>

            <input type="hidden" name="id" value="<?= htmlspecialchars($entry->getId()) ?>" />

            <label for="titel">Rezepttitel</label>
            <input type="text" id="titel" name="titel" value="<?= htmlspecialchars($entry->getTitel()) ?>" required />

            <label for="bild">Bild hochladen</label>
            <input type="file" id="bild" name="bild" value="<?= htmlspecialchars($entry->getBild()) ?>" accept="image/*" />

            <label for="zutaten">Zutaten</label>
            <textarea id="zutaten" name="zutaten" required><?= htmlspecialchars($entry->getZutaten()) ?></textarea>

            <label for="menge">Menge</label>
            <input type="text" id="menge" name="menge" value="<?= htmlspecialchars($entry->getMenge()) ?>" required />

            <label for="anleitung">Zubereitung</label>
            <textarea id="anleitung" name="anleitung" rows="6" required><?= htmlspecialchars($entry->getAnleitung()) ?></textarea>

            <label for="kurzbeschreibung">Kurzbeschreibung</label>
            <textarea id="kurzbeschreibung" name="kurzbeschreibung" rows="3"><?= htmlspecialchars($entry->getKurzbeschreibung()) ?></textarea>

            <label for="dauer">Dauer (in Minuten)</label>
            <input type="number" id="dauer" name="dauer" min="1" max="180" value="<?= htmlspecialchars($entry->getDauer()) ?>" required />

            <label for="schwierigkeit">Schwierigkeit</label>
            <select id="schwierigkeit" name="schwierigkeit" required>
                <option value="leicht" <?= $entry->getSchwierigkeit() == 'leicht' ? 'selected' : '' ?>>leicht</option>
                <option value="mittel" <?= $entry->getSchwierigkeit() == 'mittel' ? 'selected' : '' ?>>mittel</option>
                <option value="schwer" <?= $entry->getSchwierigkeit() == 'schwer' ? 'selected' : '' ?>>schwer</option>
            </select>

            <label for="preis">Preis angeben (max 50€):</label>
            <input type="number" id="preis" name="preis" min="0" max="50" step="1" value="<?= htmlspecialchars($entry->getPreis()) ?>" required />

            <input type="submit" value="Rezept aktualisieren" />
        </form>
    </main>

    <?php include_once "php/include/footer.php"; ?>
</body>