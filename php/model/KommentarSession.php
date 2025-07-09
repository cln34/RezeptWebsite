<?php
require_once "KommentarDAO.php";
require_once "KommentarEintrag.php";

class KommentarSession implements KommentarDAO{

    private static $instance = null;
    private $comments = array();

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new KommentarSession();
        }

        return self::$instance;
    }

    private function __construct()
    {
        if (isset($_SESSION["comments"])) {
            $this->comments = unserialize($_SESSION["comments"]);
        } else{
            $_SESSION["nextCommentId"] = 0;
        }
    }


    public function createComment($id, $email, $inhalt, $sterneBewertung){
        $this->comments[$_SESSION["nextCommentId"]] = new KommentarEintrag($id, $email, $inhalt, $sterneBewertung, date("Y-m-d H:i:s"));
        $_SESSION["nextCommentId"] = $_SESSION["nextCommentId"] + 1;
        $_SESSION["comments"] = serialize($this->comments);
    }


    public function readComment($id){
        foreach ($this->comments as $entry) {
            if ($entry->getId() == $id) {
                return $entry;
            }
        }
    }


    public function deleteComment($id){

    }


    public function getCommentsByRezeptId($rezeptId)
    {
        $result = [];
        foreach ($this->comments as $entry) {
            if ($entry->getId() == $rezeptId) {
                $result[] = $entry;
            }
        }
        return $result;
    }
}