<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}

require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$entry = $rezeptController->readEntry(); // Holt das Rezept basierend auf der ID

require_once "php/view/rezeptEintrag-update.php"; // Zeigt das Bearbeitungsformular an
?>