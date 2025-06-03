<?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rolle"] !== "Admin") {
  header("Location: index.php"); // nur eingeloggte Admins können auf diese seite
  exit;
}


require_once "php/include/head.php";
?>

<body>
    <?php
    require_once "php/include/header.php";
    ?>

    <main class="userliste">
        <h1>Userliste</h1>
        <div class="user-container">
            <?php if (empty($users)): ?>
                Keine Einträge vorhanden.
                <?php else:
                foreach ($users as $user): ?>
                    <div class='user-card'>
                        <span class='user-id'>ID: <?= htmlspecialchars($user->getID()) ?></span>
                        <span class='user-email'>Email: <?= htmlspecialchars($user->getEmail()) ?></span>
                        <span class='user-role'>Rolle: <?= htmlspecialchars($user->getRolle()) ?></span>

                         <!-- Link mit Button zum Löschen -->
                        <a href="user-loeschen.php?email=<?= urlencode($user->getEmail()) ?>" ><button class="delete-button">Benutzer löschen</button></a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>