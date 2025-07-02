<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "php/model/Rezept.php";
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}
$rezept_id = intval($_GET["id"]);
$dao = Rezept::getInstance();

if ($_POST["action"] === "add") {
    $dao->addFavorit($_SESSION["user_id"], $rezept_id);
} else {
    $dao->removeFavorit($_SESSION["user_id"], $rezept_id);
}

if (isset($_GET['from']) && $_GET['from'] === 'favoriten') {
    header("Location: favoriten.php");
} else {
    header("Location: rezept.php?id=" . $rezept_id);
}
exit;