<?php
require_once "php/include/head.php";
require_once "php/dummyUser.php"
?>

<body>
    <?php
    include_once "php/include/header.php";
    ?>

    <main class="userliste">
        <h1>Userliste</h1>
        <div class="user-container">
            <!-- Stellt die dummy user dar -->
            <?php foreach ($users as $email => $password) { ?>
                <div class='user-card'>
                    <span class='user-email'>Email: "<?php echo $email ?>"</span>
                    <span class='user-role'>Rolle: User</span>
                </div>
            <?php } ?>
        </div>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>