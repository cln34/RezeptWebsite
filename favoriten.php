<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // nur eingeloggte user können auf diese seite
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
        <h1>Favoriten</h1>


        <section class="flexcontainer">
            <div class="flexbox" id="box1">
                <h2>Pizza:</h2>
                <a href="rezept.php" class="box-link">
                    <img
                        src="images/pizza.jpg"
                        alt="Das ist ein Bild von Pizza"
                        title="Lecker Pizza" />
                </a>
                <div class="info-grid">
                    <div>Dauer</div>
                    <div>Schwierigkeit</div>
                    <div>Ungefährer Preis</div>
                    <div>30 min</div>
                    <div>Mittel</div>
                    <div>4€</div>
                </div>
                <p>Kurzbeschreibung: odit alias magnam rem rerum a Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos consequuntur delectus nostrum sit at quam libero! Libero odio temporibus aspernatur, eveniet nostrum error voluptatibus unde dolorum id repudiandae non quasi? t? Repellat ad odio deleniti dolore quibusdam molestiae, optio placeat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
            </div>

            <div class="flexbox" id="box2">
                <h2>Burger:</h2>
                <img
                    src="images/burger.jpg"
                    alt="Das ist ein Bild von einem Burger"
                    title="Saftiger Burger" />
                <div class="info-grid">
                    <div>Dauer</div>
                    <div>Schwierigkeit</div>
                    <div>Ungefährer Preis</div>
                    <div>20 min</div>
                    <div>Leicht</div>
                    <div>5€</div>
                </div>
                <p>Kurzbeschreibung: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed ab eos aspernatur ipsam cum repellendus culpa commodi consequuntur, velit pariatur quod dolores nisi itaque similique repellat provident sequi! Veniam!</p>
            </div>
        </section>

    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>
