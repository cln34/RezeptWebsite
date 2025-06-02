<?php 
require_once "KommentarDAO.php";
require_once "KommentarEintrag.php";

class KommentarPDOSQLite implements KommentarDAO{
    private static $instance = null;

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new KommentarPDOSQLite();
        }
        return self::$instance; //self instance wenn statisch. this->instance wenn nicht statisch
    }


    public function createComment($email, $text, $sterneBewertung){

    }


    public function readComment($id){

    }


    public function deleteComment($id){

    }


    public function getComments(){

    }

}

?>