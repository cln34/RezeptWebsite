<?php
require_once "php/model/UserSession.php";
require_once "php/model/UserPDOSQLite.php";
/*
 * je nachdem ob die Webanwendung mit der Dummy-Fix- oder der Datenbank-Implementierung laufen soll,
 * ist die Implementierung der Methode getInstance die einzige Stelle im gesamten Code, an der eine
 * Änderung erfolgen muss
 */

class User{
    public static function getInstance(){
        //return UserSession::getInstance(); //dummy fix
        return UserPDOSQLite::getInstance(); // Datenbank
    }
}
?>