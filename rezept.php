<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require_once "php/controller/EntryController.php";

$rezeptController = new RezeptController();
$entry = $rezeptController->readEntry();
// die Ausgabe des HTML-Codes kann erfolgen
require_once $abs_path . "/php/view/RezeptEintrag-show.php";
