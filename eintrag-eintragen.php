<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}


require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$rezeptController->createEntry();

// die Ausgabe des HTML-Codes kann erfolgen
header("Location: index.php");
exit;
