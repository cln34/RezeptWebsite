<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}

require_once "php/controller/UserController.php";

$userController = new UserController();
$userController->createUser();

// die Ausgabe des HTML-Codes kann erfolgen
header("Location: registrierung.php");
exit;