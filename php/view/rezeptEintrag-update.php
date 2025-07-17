<?php
require_once "php/include/head.php";
?>

<body>
    <?php include_once "php/include/header.php"; ?>

    <main class="rezeptErstellen">
        <form action="eintrag-aktualisieren.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <h1>Rezept bearbeiten</h1>

            <input type="hidden" name="id" value="<?= htmlspecialchars($entry->getId()) ?>" />

            <label for="titel">Rezepttitel</label>
            <input type="text" id="titel" name="titel" value="<?= htmlspecialchars($entry->getTitel()) ?>" required maxlength="25" />


            <div class="form-row">
                <label for="bild">Bild hochladen</label>
                <input type="file" id="bild" name="bild" value="<?= htmlspecialchars($entry->getBild()) ?>" accept="image/*" />
                <img id="bild-vorschau" src="#" alt="Bildvorschau" style="display: none; max-width: 300px; margin-top: 10px;" />
                <!-- Overlay für große Vorschau -->
                <div id="bild-overlay" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.7); justify-content:center; align-items:center; z-index:1000;">
                    <img id="bild-gross" src="#" alt="Große Bildvorschau" style="max-width:90vw; max-height:90vh; box-shadow:0 0 20px #000; background:#fff; border-radius:8px;" />
                </div>
            </div>

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
                            <button class="removeZutat-button" type="button"
                                style="<?= count($zutatenArr) > 1 ? '' : 'display:none;' ?>"
                                onclick="this.parentNode.remove(); updateZutatenButtons();">Zutat Entfernen</button>
                        </div>
                    <?php endfor; ?>
                </div>

                <button class="addZutat-button" type="button" onclick="addZutat()">Weitere Zutat hinzufügen</button>

                <?php
                $anleitungArr = $entry->getAnleitungArray();
                ?>
                <label for="anleitung-0">Zubereitung</label>
                <div id="anleitungen">
                    <?php foreach ($anleitungArr as $i => $schritt): ?>
                        <div class="anleitung-eintrag">
                            <textarea id="anleitung-<?= $i ?>" name="anleitung[]" rows="4" required placeholder="Schritt <?= $i + 1 ?>"><?= htmlspecialchars($schritt) ?></textarea>
                            <button type="button" class="removeZutat-button js-only" style="<?= count($anleitungArr) > 1 ? '' : 'display:none;' ?>" onclick="this.parentNode.remove(); updateAnleitungNummerierung();">Schritt Entfernen</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="addZutat-button js-only" type="button" onclick="addAnleitung()">Weiteren Schritt hinzufügen</button>
                <noscript>
                    <p style="color: red;">Für das Hinzufügen von Schritten wird JavaScript benötigt.</p>
                </noscript>

                <label for="kurzbeschreibung">Kurzbeschreibung</label>
                <textarea id="kurzbeschreibung" name="kurzbeschreibung" rows="3" maxlength="150"><?= htmlspecialchars($entry->getKurzbeschreibung()) ?></textarea>

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

    <script src="js/bildVorschau.js"></script>
    <script src="js/addZutat.js"></script>
</body>