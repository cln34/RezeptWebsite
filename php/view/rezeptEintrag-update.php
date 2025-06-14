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

            <div class="form-row">
                <?php
                $zutatenArr = $entry->getZutaten();
                $mengeArr = $entry->getMenge();
                ?>
                <label for="zutaten">Zutaten</label>
                <div id="zutaten-container">
                    <?php for ($i = 0; $i < count($zutatenArr); $i++): ?>
                        <div class="zutat-eintrag">
                            <select id="zutaten" name="zutaten[]" required>
                                <option value="" disabled>-- Zutat wählen --</option>
                                <option value="Mehl" <?= $zutatenArr[$i] === 'Mehl' ? 'selected' : '' ?>>Mehl</option>
                                <option value="Zucker" <?= $zutatenArr[$i] === 'Zucker' ? 'selected' : '' ?>>Zucker</option>
                                <option value="Eier" <?= $zutatenArr[$i] === 'Eier' ? 'selected' : '' ?>>Eier</option>
                                <option value="Milch" <?= $zutatenArr[$i] === 'Milch' ? 'selected' : '' ?>>Milch</option>
                                <option value="Butter" <?= $zutatenArr[$i] === 'Butter' ? 'selected' : '' ?>>Butter</option>
                                <option value="Salz" <?= $zutatenArr[$i] === 'Salz' ? 'selected' : '' ?>>Salz</option>
                                <option value="Pfeffer" <?= $zutatenArr[$i] === 'Pfeffer' ? 'selected' : '' ?>>Pfeffer</option>
                                <option value="Olivenöl" <?= $zutatenArr[$i] === 'Olivenöl' ? 'selected' : '' ?>>Olivenöl</option>
                                <option value="Sahne" <?= $zutatenArr[$i] === 'Sahne' ? 'selected' : '' ?>>Sahne</option>
                                <option value="Hefe" <?= $zutatenArr[$i] === 'Hefe' ? 'selected' : '' ?>>Hefe</option>
                                <option value="Backpulver" <?= $zutatenArr[$i] === 'Backpulver' ? 'selected' : '' ?>>Backpulver</option>
                                <option value="Vanillezucker" <?= $zutatenArr[$i] === 'Vanillezucker' ? 'selected' : '' ?>>Vanillezucker</option>
                                <option value="Zimt" <?= $zutatenArr[$i] === 'Zimt' ? 'selected' : '' ?>>Zimt</option>
                            </select>
                            <label for="menge" class="visually-hidden">Menge</label>
                            <input type="text" id="menge" name="menge[]" value="<?= htmlspecialchars($mengeArr[$i] ?? '') ?>" required>
                            <button class="removeZutat-button"  type="button" onclick="this.parentNode.remove()">Entfernen</button>
                        </div>
                    <?php endfor; ?>
                </div>

                <button class="addZutat-button" type="button" onclick="addZutat()">Weitere Zutat hinzufügen</button>

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

    <script>
        // Funktion fügt zusätzliche Zutaten hinzu
        function addZutat() {
            const container = document.getElementById('zutaten-container');
            const index = container.children.length;

            // Neues Zutaten/Mengen-Paar als HTML
            const div = document.createElement('div');
            div.className = 'zutat-eintrag';
            div.innerHTML = `
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
    </select>
    <input type="text" name="menge[]" placeholder="Menge (z. B. 200g)" required>
    <button type="button" onclick="this.parentNode.remove()">Zutat entfernen</button>
  `;
            container.appendChild(div);
        }
    </script>
</body>