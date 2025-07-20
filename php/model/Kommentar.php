<?php
require_once "KommentarPDOSQLite.php";
require_once "KommentarSession.php";

class Kommentar{
    public static function getInstance(){
        //return KommentarSession::getInstance(); //Session
        return KommentarPDOSQLite::getInstance(); //Datenbank
    }

}
?>