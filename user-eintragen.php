<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


require_once "php/controller/UserController.php";

$userController = new UserController();
$userController->createUser();

// die Ausgabe des HTML-Codes kann erfolgen
header("Location: registrierung.php");
exit;