<?php
require_once "Kommentar.php";
require_once "KommentarEintrag.php";

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

            $_SESSION["message"] = "delete_comment"
        } catch (MissingEntryException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleMissingEntryException();
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
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