<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


require_once "php/controller/KommentarController.php";

$kommentarController = new KommentarController();
$kommentarController->createComment();

// die Ausgabe des HTML-Codes kann erfolgen
header("Location: kommentare.php?id=" . urlencode($_POST['rezept_id']));
exit;
