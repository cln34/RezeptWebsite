<?php
session_start();

// Initialisiere das Rezepte-Array, falls es noch nicht existiert
if (!isset($_SESSION['rezepte'])) {
    $_SESSION['rezepte'] = [];
}

// Extrahiere die Formulardaten
$titel = $_POST['titel'];
$beschreibung = $_POST['beschreibung'];
$dauer = $_POST['dauer'];
$schwierigkeit = $_POST['schwierigkeit'];
$preis = $_POST['preis'];
$anleitung = $_POST['anleitung'];
$zutaten = $_POST['zutaten'];
$mengen = $_POST['mengen'];

// Bild verarbeiten
$bildName = '';
if (isset($_FILES['bild']) && $_FILES['bild']['error'] == 0) {
    $uploadDir = 'images/';
    $bildName = uniqid() . '_' . basename($_FILES['bild']['name']);
    move_uploaded_file($_FILES['bild']['tmp_name'], $uploadDir . $bildName);
}

// Kombiniere Zutaten und Mengen
$zutatenMitMenge = [];
foreach ($zutaten as $index => $zutat) {
    $menge = $mengen[$index];
    $zutatenMitMenge[] = ['zutat' => $zutat, 'menge' => $menge];
}

// Neues Rezept erstellen
$rezept = [
    'titel' => $titel,
    'beschreibung' => $beschreibung,
    'dauer' => $dauer,
    'schwierigkeit' => $schwierigkeit,
    'preis' => $preis,
    'anleitung' => $anleitung,
    'zutaten' => $zutatenMitMenge,
    'bild' => $bildName
];

// Rezept zur Session hinzufügen
$_SESSION['rezepte'][] = $rezept;

// Weiterleitung zur Startseite oder Rezeptansicht
header("Location: index.php");
exit;
?>