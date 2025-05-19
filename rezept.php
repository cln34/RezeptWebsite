<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$entry = $rezeptController->readEntry();
// die Ausgabe des HTML-Codes kann erfolgen

//bin unsicher, ob das __DIR__ . so richtig ist
require_once __DIR__ . "/php/view/RezeptEintrag-show.php";
