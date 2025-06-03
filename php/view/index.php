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
                    <label for="Suche" class="visually-hidden">Suche</label> <!-- Unsichtbares Label für Barrierefreiheit -->

                    <input class="search-input" type="search" id="Suche" name="Sucheingabe" placeholder="Neue Rezepte entdecken:" size="90" required>
                </div> <!--name ist name für die eingegeben daten, eine variable sozusagen-->
            </form>
        </section>

        <ul>
            <section class="flexcontainer">
                <?php if (empty($entries)): ?>
                    Keine Einträge vorhanden.
                    <?php else:
                    foreach ($entries as $entry): ?>
                        <div class="flexbox">
                            <h2><?= htmlspecialchars($entry->getTitel()) ?></h2>
                            <a href="rezept.php?id=<?= urlencode($entry->getId()) ?>" class="box-link">
                                <img
                                    src="images/<?= htmlspecialchars($entry->getBild()) ?>"
                                    alt="Bild von <?= htmlspecialchars($entry->getTitel()) ?>"
                                    title="<?= htmlspecialchars($entry->getTitel()) ?>" />
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
        </ul>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>