<?php
require_once "php/controller/UserController.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Prüfe ob die E-Mail übergeben wurde und die Rolle Admin ist
if (isset($_GET["email"]) && $_SESSION["rolle"] === "Admin") {
    $email = $_GET["email"];

    $controller = new UserController();
    $controller->deleteUser($email);
}

// Danach zurück zur Userliste
header("Location: userliste.php");
exit;