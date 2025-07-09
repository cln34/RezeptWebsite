<?php
require_once "php/model/Kommentar.php";
require_once "php/model/KommentarEintrag.php";

class KommentarController
{
    public function createComment()
    {
        $this->checkCSRF();
        //Ueberpruefung der Parameter
        $this->checkEntryParam();
        if (!$this->checkEntryRequiredParam()) {
            header("Location: kommentare.php?id=" . urlencode($_POST['rezept_id']));
            exit;
        }

        try {
            $kommentar = Kommentar::getInstance();
            $kommentar->createComment($_POST["rezept_id"], $_POST["email"], $_POST["inhalt"], $_POST["sterneBewertung"]);

            $_SESSION["message"] = "new_comment";
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }

    public function readComment() //Wird zurzeit gar nicht benutzt, evtl. für Kommentar bearbeiten, aber eig brauchen wir die Funktion nicht
    {
        $this->checkId();
        try {
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
        $this->checkCSRF();
        $this->checkId();

        try {
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

    public function request($rezeptId)
    {
        try {
            $comment = Kommentar::getInstance();
            $comments = $comment->getCommentsByRezeptId($rezeptId);
            return $comments;
        } catch (InternalErrorException $exc) {
            $_SESSION["message"] = "internal_error";
        }
    }


    private function checkId()
    {
        if (!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
            $this->handleMissingEntryException();
        }
    }

    private function checkEntryParam()
    {
        if (
            !isset($_POST["rezept_id"]) ||
            !isset($_POST["email"]) ||
            !isset($_POST["inhalt"]) 
            // sterneBewertung ist optional
        ) {
            $_SESSION["message"] = "missing_parameters";
            header("Location: kommentare.php?id=" . urlencode($_POST['rezept_id']));
            exit;
        }
    }

    private function checkEntryRequiredParam()
    {
        if (
            empty($_POST["rezept_id"]) ||
            empty($_POST["email"]) ||
            empty($_POST["inhalt"])
            // sterneBewertung ist optional
        ) {
            $_SESSION["message"] = "missing_required_parameters";
            $_SESSION["rezept_id"] = $_POST["rezept_id"] ?? '';
            $_SESSION["email"] = $_POST["email"] ?? '';
            $_SESSION["inhalt"] = $_POST["inhalt"] ?? '';
            $_SESSION["sterneBewertung"] = $_POST["sterneBewertung"] ?? '';
            return false;
        } else {
            return true;
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

    private function checkCSRF()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die("CSRF-Angriff erkannt!");
        }
    }
}
