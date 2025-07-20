<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once  "php/controller/RezeptController.php";

$entryController = new RezeptController();
$entryController->deleteEntry();

// die Ausgabe des HTML-Codes kann erfolgen
header("Location: index.php");
exit;
