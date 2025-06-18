<?php
require_once "php/controller/IndexController.php";

$suche = $_GET['query'] ?? '';
$sortierung = $_GET['sortierung'] ?? 'datum_desc';

$indexController = new IndexController();
if ($suche && strlen($suche) >= 2) {
    $entries = $indexController->requestSearchEntries($suche);
} else {
    $entries = $indexController->request();
}

// Sortierung wie in index.php
switch ($sortierung) {
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

?>
<section class="flexcontainer" id="rezeptListe">
    <?php if (empty($entries)): ?>
        Keine Einträge vorhanden.
    <?php else: ?>
        <?php foreach ($entries as $entry): ?>
            <div class="flexbox">
                <h2><?= htmlspecialchars($entry->getTitel()) ?></h2>
                <a href="rezept.php?id=<?= urlencode($entry->getId()) ?>" class="box-link">
                    <img src="RezeptBild.php?id=<?= urlencode($entry->getId()) ?>"
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