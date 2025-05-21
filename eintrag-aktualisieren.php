<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Verarbeiten des Datei-Uploads
if (isset($_FILES['bild']) && $_FILES['bild']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'images/';
    $uploadFile = $uploadDir . basename($_FILES['bild']['name']);

    // Überprüfen, ob der Upload erfolgreich ist
    if (move_uploaded_file($_FILES['bild']['tmp_name'], $uploadFile)) {
        $_POST['bild'] = $_FILES['bild']['name']; // Speichern des Dateinamens in $_POST
    } else {
        $_SESSION["message"] = "upload_error";
        header("Location: rezept.php?id=" . urlencode($_POST['id']));
        exit;
    }
} else {
    // Wenn kein neues Bild hochgeladen wurde, behalten Sie das alte Bild
    $_POST['bild'] = $_POST['bild'] ?? null;
}
require_once "php/controller/RezeptController.php";

$rezeptController = new RezeptController();
$rezeptController->updateEntry(); // Aktualisiert das Rezept

header("Location: rezept.php?id=" . urlencode($_POST['id'])); // Leitet zurück zur Rezeptseite
exit;
?>