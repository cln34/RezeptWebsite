<?php
require_once "KommentarPDOSQLite.php";

class Kommentar{
    public static function getInstance(){
        //kommentar nur mit db umsetzung
        return KommentarPDOSQLite::getInstance();
    }

}
?>