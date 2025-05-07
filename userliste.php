<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rezeptesammlung">
    <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas">
    <link rel="stylesheet" href="css/main.css" />
    <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
    <?php
    include_once "php/header.php";
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
    include_once "php/footer.php"
    ?>
</body>

</html>