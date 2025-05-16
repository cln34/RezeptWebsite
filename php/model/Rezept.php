<?php
require_once "php/model/RezeptEintrag.php";
/*
 * je nachdem ob die Webanwendung mit der Dummy-Fix- oder der Datenbank-Implementierung laufen soll,
 * ist die Implementierung der Methode getInstance die einzige Stelle im gesamten Code, an der eine
 * Änderung erfolgen muss
 */

class Rezept{
    public static function getInstance(){
        return RezeptSession::getInstance(); //dummy fix
        //return RezeptDB::getInstance(); // Datenbank
    }
}
?>