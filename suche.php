<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}
require_once "php/controller/IndexController.php";

$indexController = new IndexController();
$entries = $indexController->requestSearchEntries($_GET["Sucheingabe"]);
// gibt index php zurück aber nur mit den Einträgen die in der Suche gefunden wurden
require_once "php/view/index.php";
?>