<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

//die Ausgabe des php codes kann erfolgen
require_once "php/view/user-anmelden.php";

?>

