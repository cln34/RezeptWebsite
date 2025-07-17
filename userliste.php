<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require_once "php/controller/UserController.php";

$userController = new UserController();
$users = $userController->request();
// die Ausgabe des HTML-Codes kann erfolgen
require_once "php/view/userliste.php";
