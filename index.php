<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require_once "php/controller/IndexController.php";

$indexController = new IndexController();
$entries = $indexController->request();
// die Ausgabe des HTML-Codes kann erfolgen
require_once "php/view/index.php";