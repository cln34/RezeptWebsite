<?php
require_once "php/include/head.php";
?>

<body>
    <?php
    require_once "php/include/header.php";
    ?>
    <main>
        <?php if (isset($_SESSION["message"]) && $_SESSION["message"] == "invalid_entry_id"): ?>
            <p>
                Das Rezept kann leider nicht gefunden werden.
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "internal_error"): ?>
            <p>
                Es ist ein interner Fehler aufgetreten.
                Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "missing_required_parameters"): ?>
            <p>
                Fehler beim Aufruf der Seite: Es fehlen notwendige Parameter!
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "new_entry"): ?>
            <p>
                Neuer Eintrag wurde hinzugefügt!
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "delete_entry"): ?>
            <p>
                Eintrag wurde gelöscht!
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "no_entry_found"): ?>
            <p>
                Es wurde kein Rezept zu deiner Suche gefunden!
            </p>

        <?php endif; ?>
        <?php
        unset($_SESSION["message"]);
        ?>

        <h1>StudiRezepte - Einfach & Günstig</h1>
        <section class="search-container">
            <form action="suche.php" method="get">
                <div class="search">
                    <label for="rezeptSuche" class="visually-hidden">Suche</label> <!-- Unsichtbares Label für Barrierefreiheit -->

                    <input class="search-input" type="search" id="rezeptSuche" name="Sucheingabe" placeholder="Neue Rezepte entdecken:" size="90" required>
                    <noscript>
                        <button type="submit" class="search-button">Suchen</button>
                    </noscript>

                </div> <!--name ist name für die eingegeben daten, eine variable sozusagen-->
            </form>
        </section>

        <form method="get" id="sortierForm">
            <label for="sortierung">Sortieren nach:</label>
            <select name="sortierung" id="sortierung" onchange="document.getElementById('sortierForm').submit()">
                <option value="datum_desc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'datum_desc') ? 'selected' : '' ?>>Neueste zuerst</option>
                <option value="datum_asc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'datum_asc') ? 'selected' : '' ?>>Älteste zuerst</option>
                <option value="titel_asc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'titel_asc') ? 'selected' : '' ?>>Titel (A–Z)</option>
                <option value="titel_desc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'titel_desc') ? 'selected' : '' ?>>Titel (Z–A)</option>
                <option value="preis_asc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'preis_asc') ? 'selected' : '' ?>>Preis (aufsteigend)</option>
                <option value="preis_desc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'preis_desc') ? 'selected' : '' ?>>Preis (absteigend)</option>
                <option value="dauer_asc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'dauer_asc') ? 'selected' : '' ?>>Dauer (kürzeste zuerst)</option>
                <option value="dauer_desc" <?= (isset($_GET['sortierung']) && $_GET['sortierung'] === 'dauer_desc') ? 'selected' : '' ?>>Dauer (längste zuerst)</option>
            </select>

            <noscript>
                <button type="submit" class="sortier-button">Sortieren</button>
            </noscript>
        </form>

            <section class="flexcontainer" id="rezeptListe">
                <?php if (empty($entries)): ?>
                    Keine Einträge vorhanden.
                <?php else:
                    // Sortierung wie gehabt
                    if (!isset($_GET['sortierung'])) {
                        $_GET['sortierung'] = 'datum_desc';
                    }
                    if (isset($_GET['sortierung'])) {
                        switch ($_GET['sortierung']) {
                            case 'datum_desc':
                                usort($entries, fn($a, $b) => strtotime($b->getDatum()) <=> strtotime($a->getDatum()));
                                break;
                            case 'datum_asc':
                                usort($entries, fn($a, $b) => strtotime($a->getDatum()) <=> strtotime($b->getDatum()));
                                break;
                            case 'titel_asc':
                                usort($entries, fn($a, $b) => strcmp($a->getTitel(), $b->getTitel()));
                                break;
                            case 'titel_desc':
                                usort($entries, fn($a, $b) => strcmp($b->getTitel(), $a->getTitel()));
                                break;
                            case 'preis_asc':
                                usort($entries, fn($a, $b) => $a->getPreis() <=> $b->getPreis());
                                break;
                            case 'preis_desc':
                                usort($entries, fn($a, $b) => $b->getPreis() <=> $a->getPreis());
                                break;
                            case 'dauer_asc':
                                usort($entries, fn($a, $b) => $a->getDauer() <=> $b->getDauer());
                                break;
                            case 'dauer_desc':
                                usort($entries, fn($a, $b) => $b->getDauer() <=> $a->getDauer());
                                break;
                        }
                    }

                    foreach ($entries as $entry): ?>
                        <div class="flexbox">
                            <h2><?= htmlspecialchars($entry->getTitel()) ?></h2>
                            <a href="rezept.php?id=<?= urlencode($entry->getId()) ?>" class="box-link">
                                <img
                                    src="RezeptBild.php?id=<?= urlencode($entry->getId()) ?>"
                                    alt="Bild von <?= htmlspecialchars($entry->getTitel()) ?>">
                            </a>
                            <div class="info-grid">
                                <div>Dauer</div>
                                <div>Schwierigkeit</div>
                                <div>Ungefährer Preis</div>
                                <div><?= htmlspecialchars($entry->getDauer()) ?> min</div>
                                <div><?= htmlspecialchars($entry->getSchwierigkeit()) ?></div>
                                <div><?= htmlspecialchars($entry->getPreis()) ?> €</div>
                            </div>
                            <p>Kurzbeschreibung: <?= htmlspecialchars($entry->getKurzbeschreibung()) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
    <script src="js/scripts.js"></script>

</body>

</html>