<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$rezeptController->updateEntry(); // Aktualisiert das Rezept

header("Location: rezept.php?id=" . urlencode($_POST['id'])); // Leitet zurück zur Rezeptseite
exit;
?>