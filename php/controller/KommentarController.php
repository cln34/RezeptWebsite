<?php
require_once "php/model/Kommentar.php";
require_once "php/model/KommentarEintrag.php";

class KommentarController{
    public function createComment(){
        //TODO: Ueberpruefung der Parameter
        //$this->checkEntryParam();#

        try{
            $kommentar = Kommentar::getInstance();
            $kommentar->createComment($_POST["email"], $_POST["text"], $_POST["sterneBewertung"]);

            $_SESSION["message"] = "new_comment";
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }

    public function readComment(){
        $this->checkId();
        try{
            $id = intval($_GET["id"]);

            $kommentar = Kommentar::getInstance();
            return $kommentar->readComment($id);

        } catch (MissingEntryException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleMissingEntryException();
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }

    public function deleteComment(){
        $this->checkId();

        try{
            $id = intval($_GET["id"]);
            $kommentar = Kommentar::getInstance();
            $kommentar->deleteComment($id);

            $_SESSION["message"] = "delete_comment";
        } catch (MissingEntryException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleMissingEntryException();
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }

    public function request()
    {
        // Ueberpruefung der Parameter, Hinweis: Es gibt keine Parameter
        try {

            // Aufbereitung der Daten fuer die Kontaktierung des Models
            // Hinweis: Es werden keine Daten benoetigt

            // Kontaktierung des Models (Geschaeftslogik)
            $comment = Kommentar::getInstance();
            $comments = $comment->getComments();

            // Aufbereitung der Daten fuer die Ausgabe (View), Hinweis: in diesem Fall nichts zu tun
            return $comments;
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $_SESSION["message"] = "internal_error";
        }
    }


    private function checkId()
    {
        if (!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
            $this->handleMissingEntryException();
        }
    }


    private function handleMissingEntryException()
    {
        $_SESSION["message"] = "invalid_entry_id";
        header("Location: index.php");
        exit;
    }
    private function handleInternalErrorException()
    {
        $_SESSION["message"] = "internal_error";
        header("Location: index.php");
        exit;
    }
}

?>