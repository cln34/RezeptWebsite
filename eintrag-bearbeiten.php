<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$entry = $rezeptController->readEntry(); // Holt das Rezept basierend auf der ID

require_once "php/view/rezeptEintrag-update.php"; // Zeigt das Bearbeitungsformular an
?>