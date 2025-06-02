<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}
//die Ausgabe des php codes kann erfolgen
require_once "php/view/user-registrieren.php";

?>
