<?php 
require_once "php/model/RezeptEintrag.php"; 
require_once "php/model/Rezept.php";

class RezeptController{
    //erzeugt einen neuen RezeptEintrag
    public function createEntry(){
        //überprüft parameter
        $this->checkEntryParam();


        if (!$this->checkEntryEmail()) {
            header("Location: eintrag-neu.php");
            exit;
        }

        try {
            // Aufbereitung der Daten fuer die Kontaktierung des Models
            // Hinweis: hier nichts zu tun

            // Kontaktierung des Models (Geschaeftslogik)
            $rezept = Rezept::getInstance();
            $rezept->createEntry(
                $_POST["title"],
                $_POST["email"],
                $_POST["kurzbeschreibung"],
                $_POST["dauer"],
                $_POST["schwierigkeit"],
                $_POST["preis"],
                $_POST["zutaten"],
                $_POST["anleitung"],
                $_POST["bild"]
            );

            // Aufbereitung der Daten fuer die Ausgabe (View)
            $_SESSION["message"] = "new_entry";
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }

    }
     //TODO: checkEntryRequiredParam()
     
    private function checkEntryParam()
    {
        if (!isset($_POST["title"]) || !isset($_POST["email"]) || !isset($_POST["text"]) || /*|| für die restlichen paramertet*/ !isset($_POST["submit"])) {
            $_SESSION["message"] = "missing_parameters";
            header("Location: index.php");
            exit;
        }
    }

    private function checkEntryEmail()
    {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { // syntaktisch korrekte EMail-Adresse?
            $_SESSION["message"] = "wrong_email";
            //bereits eingegebene Werte in die Session speichern, damit diese nicht nochmal eingegeben werden müssen
            $_SESSION["title"] = $_POST["title"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["text"] = $_POST["text"];
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
}

?>

