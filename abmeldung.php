<?php
session_start();
if(isset($_SESSION["email"])){
    echo $_SESSION["email"];
}
   if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && isset($_POST['abmelden'])){
    session_destroy();
    header("Location: anmeldung.php");
   }
?>

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
    include_once "php/include/header.php";
    ?>

    <main>
        <h1>Abmeldung</h1>
        <hr>
        <h2>Sind Sie sicher, dass Sie sich abmelden wollen?</h2>
        <form method="post">
            <button name="abmelden">Abmelden</button>
        </form>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>

</body>

</html>