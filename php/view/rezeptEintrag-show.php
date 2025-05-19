<?php
require_once "php/include/head.php";
?>

<body>
    <?php
    require_once "php/include/header.php";
    ?>
    <main class="rezept-container">
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
        <?php endif; ?>
        <?php
        unset($_SESSION["message"]);
        ?>
        <h1>Rezept</h1>
        <h2>
            <?= htmlspecialchars($entry->getTitel()) ?>
        </h2>
        <img
            src="images/<?= htmlspecialchars($entry->getBild()) ?>"
            alt="Bild von <?= htmlspecialchars($entry->getTitel()) ?>"
            title="<?= htmlspecialchars($entry->getTitel()) ?>"
            class="rezept-bild" />
        <div class="table-container">
            <div class="table-header">
                <div>Dauer</div>
                <div>Schwierigkeit</div>
                <div>Ungefährer Preis</div>
            </div>
            <div class="table-row">
                <div>
                    <?= htmlspecialchars($entry->getDauer()) ?>
                </div>
                <div>
                    <?= htmlspecialchars($entry->getSchwierigkeit()) ?>
                </div>
                <div>
                    <?= htmlspecialchars($entry->getPreis()) ?>
                </div>
            </div>
        </div>
        <div class="table-container">
            <div class="table-header">
                <div>Zutat</div>
                <div>Menge</div>
            </div>
            <div class="table-row">
                <div>
                    <?= htmlspecialchars($entry->getZutaten()) ?>
                </div>
                <div>
                    <?= htmlspecialchars($entry->getMenge()) ?>
                </div>
            </div>
        </div>
        <div class="rezept-schritt">
            <h3>1. Schritt</h3>
            <p>
                <?= htmlspecialchars($entry->getAnleitung()) ?>
            </p>
        </div>
    </main>
    <a href="eintrag-loeschen.php?id=<?= urlencode($entry->getId()) ?>"><button> Rezept löschen </button></a>
    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>