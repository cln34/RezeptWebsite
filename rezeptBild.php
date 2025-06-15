<?php
require_once "php/model/Rezept.php";
$id = $_GET['id'] ?? null;
if (!$id) exit;

$dao = Rezept::getInstance();
$eintrag = $dao->readEntry($id);
$bild = $eintrag->getBild();

if ($bild) {
    header("Content-Type: image/jpeg"); // oder image/png, je nach Upload
    echo $bild;
} else {
    // Optional: Platzhalterbild ausgeben
    readfile("keinbild.jpg");
}