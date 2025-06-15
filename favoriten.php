<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
  echo $_SESSION["email"];
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

require_once "php/model/Rezept.php";

$dao = Rezept::getInstance();
$favoriten_ids = $dao->getFavoriten($_SESSION["email"]);
$entries = [];
foreach ($favoriten_ids as $rid) {
    try {
        $entries[] = $dao->readEntry($rid);
    } catch (Exception $e) {
        // Falls ein Rezept gelöscht wurde, einfach überspringen
    }
}

// Übergib die $entries an das View
require_once "php/view/favoriten_show.php";