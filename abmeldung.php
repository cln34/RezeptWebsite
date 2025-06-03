<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && isset($_POST['abmelden'])) {
    session_destroy();
    header("Location: anmeldung.php");
    exit;
}
?>

<?php
require_once "php/include/head.php";
?>

<body>
    <?php
    include_once "php/include/header.php";
    ?>

    <main>
        <h1>Abmeldung</h1>
        <hr>
        <section class="abmeldung-section">
        <h2>Sind Sie sicher, dass Sie sich abmelden wollen?</h2>
        <form method="post">
            <button name="abmelden" class="button">Abmelden</button>
        </form>
        </section>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>

</body>

</html>