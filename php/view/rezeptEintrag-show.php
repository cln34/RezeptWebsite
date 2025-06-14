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
        <h3>
            <?= htmlspecialchars($entry->getEmail()) ?>
        </h3>
        <img
            src="images/<?= htmlspecialchars($entry->getBild()) ?>"
            alt="Bild von <?= htmlspecialchars($entry->getTitel()) ?>"
            title="<?= htmlspecialchars($entry->getTitel()) ?>"
            class="rezept-bild" />

        <!-- Erste Tabelle: Dauer / Schwierigkeit / Preis -->
        <div class="table-container info-table">
            <div class="table-header">
                <div>Dauer</div>
                <div>Schwierigkeit</div>
                <div>Ungefährer Preis</div>
            </div>
            <div class="table-row">
                <div class="table-cell header-cell">Dauer</div>
                <div class="table-cell"><?= htmlspecialchars($entry->getDauer()) ?> min</div>

                <div class="table-cell header-cell">Schwierigkeit</div>
                <div class="table-cell"><?= htmlspecialchars($entry->getSchwierigkeit()) ?></div>

                <div class="table-cell header-cell">Ungefährer Preis</div>
                <div class="table-cell"><?= htmlspecialchars($entry->getPreis()) ?> €</div>
            </div>
        </div>

        <!-- Zweite Tabelle: Zutaten und Menge -->
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
        <a href="kommentare.php?id=<?= urlencode($entry->getId()) ?>" class="rezept-button">Kommentare ansehen </a>
    </main>
    <?php if (isset($_SESSION["email"]) && $_SESSION["email"] == $entry->getEmail()) { ?>
        <a href="eintrag-loeschen.php?id=<?= urlencode($entry->getId()) ?>"><button class="rezept-button"> Rezept löschen </button></a>
        <a href="eintrag-bearbeiten.php?id=<?= urlencode($entry->getId()) ?>"><button class="rezept-button"> Rezept bearbeiten </button></a>
    <?php } ?>
    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>