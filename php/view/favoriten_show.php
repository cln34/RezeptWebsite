<?php
require_once "php/include/head.php";
?>

<body>
    <?php require_once "php/include/header.php"; ?>
    <main>
        <h1>Meine Favoriten</h1>

        
        <section class="search-container">
            <form method="get" id="favoritenSucheForm">
                <div class="search">
                    <label for="favoritenSuche" class="visually-hidden">Suche</label>
                    <input class="search-input" type="search" id="favoritenSuche" name="suche" placeholder="Favoriten durchsuchen:" size="90">
                </div>
            </form>
        </section>

        <!-- Sortierfunktion -->
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
        </form>

        <?php
        // Filter nach Suchbegriff
        if (!empty($_GET['suche'])) {
            $suchbegriff = mb_strtolower(trim($_GET['suche']));
            $entries = array_filter($entries, function($entry) use ($suchbegriff) {
                return mb_strpos(mb_strtolower($entry->getTitel()), $suchbegriff) !== false
                    || mb_strpos(mb_strtolower($entry->getKurzbeschreibung()), $suchbegriff) !== false;
            });
        }

        // Sortierlogik
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
        ?>

        <section class="flexcontainer">
            <?php if (empty($entries)): ?>
                <p>Du hast noch keine Favoriten gespeichert.</p>
            <?php else: ?>
                <?php foreach ($entries as $entry): ?>
                    <div class="flexbox">
                        <h2><?= htmlspecialchars($entry->getTitel()) ?></h2>
                        <a href="rezept.php?id=<?= urlencode($entry->getId()) ?>" class="box-link">
                            <?php
                            $bild = $entry->getBild();
                            if ($bild && strlen($bild) < 255 && preg_match('/\.(jpg|jpeg|png|gif)$/i', $bild)) {
                                echo '<img src="images/' . htmlspecialchars($bild) . '" alt="Bild von ' . htmlspecialchars($entry->getTitel()) . '">';
                            } else {
                                echo '<img src="rezeptBild.php?id=' . urlencode($entry->getId()) . '" alt="Bild von ' . htmlspecialchars($entry->getTitel()) . '">';
                            }
                            ?>
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
                        <form method="post" action="favourit-toggle.php?id=<?= urlencode($entry->getId()) ?>&from=favoriten">
                            <button type="submit" name="action" value="remove" class="rezept-button">Aus Favoriten entfernen</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
    <?php include_once "php/include/footer.php"; ?>
</body>
</html>