<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Neue einfache Prüfung – keine GET-Werte nötig
if (!isset($_SESSION["pending_email"]) || !isset($_SESSION["pending_passwort"])) {
    echo "Registrierung ungültig oder abgelaufen.";
    exit;
}

require_once "php/controller/UserController.php";

// Fülle $_POST – damit createUser wie gewohnt funktioniert
$_POST["email"] = $_SESSION["pending_email"];
$_POST["passwort"] = $_SESSION["pending_passwort"];
$_POST["passwortWDH"] = $_SESSION["pending_passwort"];

$userController = new UserController();
$userController->createUser();

// Session aufräumen
unset($_SESSION["pending_email"], $_SESSION["pending_passwort"]);

// Weiterleitung zur Anmeldung
header("Location: anmeldung.php");
exit;
