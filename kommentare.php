<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}

require_once "php/controller/KommentarController.php";

$kommentarController = new KommentarController();
$rezeptId = $_GET['id'] ?? null;
$comments = $kommentarController->request($rezeptId);
// die Ausgabe des HTML-Codes kann erfolgen
require_once "php/view/kommentare_view.php";