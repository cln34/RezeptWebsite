<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//die Ausgabe des php codes kann erfolgen
require_once "php/view/user-anmelden.php";

?>

