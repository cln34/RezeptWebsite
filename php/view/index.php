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
                Das Rezetp kann leider nicht gefunden werden.
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "internal_error"): ?>
            <p>
                Es ist ein interner Fehler aufgetreten.
                Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.
            </p>
        <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "missing_parameters"): ?>
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

        <h1>StudiRezepte - Einfach & Günstig</h1>

        <ul>
            <?php if (empty($entries)): ?>
                Keine Einträge vorhanden.
                <?php else:
                foreach ($entries as $entry): ?>
                    <li><a href="eintrag-anzeigen.php?id=<?= urlencode($entry->getId()) ?>">
                            <?= htmlspecialchars($entry->getTitle()) ?>
                        </a> |
                        <a href="eintrag-loeschen.php?id=<?= urlencode($entry->getId()) ?>">löschen</a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>
