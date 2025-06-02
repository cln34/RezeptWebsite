<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if (isset($_SESSION["email"])) {
  echo $_SESSION["email"];
}

require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$entry = $rezeptController->readEntry();
// die Ausgabe des HTML-Codes kann erfolgen

require_once "php/view/RezeptEintrag-show.php";


