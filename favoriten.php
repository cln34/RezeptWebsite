<?php
session_start();
require_once "php/include/head.php";
require_once "php/include/header.php";
require_once "php/model/Rezept.php";

// Prüfen, ob der Nutzer eingeloggt ist
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

$dao = Rezept::getInstance();
$favoriten_ids = $dao->getFavoriten($_SESSION["email"]);
$entries = [];
foreach ($favoriten_ids as $rid) {
    try {
        $entries[] = $dao->readEntry($rid);
    } catch (Exception $e) {
        // Falls ein Rezept gelöscht wurde, einfach überspringen
    }
}
?>

<body>
    <main>
        <h1>Meine Favoriten</h1>
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