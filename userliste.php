<?php
require_once "php/include/head.php";
?>

<body>
    <?php
    include_once "php/include/header.php";
    ?>

    <main class="userliste">
        <h1>Userliste</h1>
        <div class="user-container">
            <!-- Beispiel-Daten -->
            <div class="user-card">
                <span class="user-id">ID: 1</span>
                <span class="user-name">Colin</span>
                <span class="user-email">colin@example.com</span>
                <span class="user-role">Rolle: Admin</span>
            </div>
            <div class="user-card">
                <span class="user-id">ID: 2</span>
                <span class="user-name">Chris</span>
                <span class="user-email">chris@example.com</span>
                <span class="user-role">Rolle: User</span>
            </div>
            <div class="user-card">
                <span class="user-id">ID: 3</span>
                <span class="user-name">Sascha</span>
                <span class="user-email">sascha@example.com</span>
                <span class="user-role">Rolle: User</span>
            </div>
            <!-- Weitere Benutzer -->
        </div>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>
