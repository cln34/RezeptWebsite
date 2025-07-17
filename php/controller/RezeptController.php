<?php
require_once "php/model/RezeptEintrag.php";
require_once "php/model/Rezept.php";

class RezeptController
{
    private $entries = []; // Define the $entries property
    //erzeugt einen neuen RezeptEintrag
    public function createEntry()
    {
        $this->checkCSRF();

        //überprüft parameter
        $this->checkEntryRequiredParam();

        if (!$this->checkEntryEmail()) {

            header("Location: rezeptErstellen.php");

            exit;
        }

        try {
            // Aufbereitung der Daten fuer die Kontaktierung des Models

            // Kontaktierung des Models (Geschaeftslogik)
            $rezept = Rezept::getInstance();
            $bildBlob = null;
            if (isset($_FILES['bild']) && $_FILES['bild']['error'] === UPLOAD_ERR_OK) {
                $bildBlob = file_get_contents($_FILES['bild']['tmp_name']);
            }
            $anleitung = is_array($_POST['anleitung']) ? implode('||', $_POST['anleitung']) : $_POST['anleitung'];
            $rezept->createEntry(
                $_POST["titel"],
                $_POST["email"],
                $_POST["kurzbeschreibung"],
                $_POST["dauer"],
                $_POST["schwierigkeit"],
                $_POST["preis"],
                //php syntax "?=wenn die bedingung stimmt" ": else"
                // Wandelt die Zutaten- und Mengen-Arrays (wenn es arrays sind) aus dem Formular in kommaseparierte Strings um, damit sie korrekt in der Datenbank gespeichert werden
                $_POST['zutaten'] = is_array($_POST['zutaten']) ? implode(',', $_POST['zutaten']) : $_POST['zutaten'],
                $_POST['menge'] = is_array($_POST['menge']) ? implode(',', $_POST['menge']) : $_POST['menge'],
                $anleitung,
                $bildBlob
            );


            // Aufbereitung der Daten fuer die Ausgabe (View)
            $_SESSION["message"] = "new_entry";
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }

    public function readEntry()
    {
        // Ueberpruefung der Parameter
        $this->checkId();

        try {
            // Aufbereitung der Daten fuer die Kontaktierung des Models
            $id = intval($_GET["id"]);

            // Kontaktierung des Models (Geschaeftslogik)
            $rezept = Rezept::getInstance();
            $entry = $rezept->readEntry($id);

            // Aufbereitung der Daten fuer die Ausgabe (View), Hinweis: in diesem Fall nichts zu tun
            return $entry;
        } catch (MissingEntryException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleMissingEntryException();
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }

    /*TODO: checkEntryParam()*/
    private function checkEntryRequiredParam()
    {
        if (
            !isset($_POST["titel"]) || !isset($_POST["kurzbeschreibung"]) ||
            !isset($_POST["dauer"]) ||  !isset($_POST["schwierigkeit"]) ||  !isset($_POST["preis"])
            || !isset($_POST["zutaten"]) || !isset($_POST["menge"]) ||  !isset($_POST["anleitung"]) /*|| !isset($_POST["email"])*/
        ) {
            $_SESSION["message"] = "missing_required_parameters";
            header("Location: index.php");
            exit;
        }
    }

    private function checkEntryEmail()
    {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { // syntaktisch korrekte EMail-Adresse?
            $_SESSION["message"] = "wrong_email";
            //bereits eingegebene Werte in die Session speichern, damit diese nicht nochmal eingegeben werden müssen
            $_SESSION["titel"] = $_POST["titel"];
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

    private function checkId()
    {
        if (!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
            $this->handleMissingEntryException();
        }
    }

    // löscht einen existierendes Rezept
    public function deleteEntry()
    {
        $this->checkCSRF();
        // Ueberpruefung der Parameter
        $this->checkId();

        try {
            // Aufbereitung der Daten fuer die Kontaktierung des Models
            // Hinweis: hier nichts zu tun

            // Kontaktierung des Models (Geschaeftslogik)
            $rezept = Rezept::getInstance();
            $rezept->deleteEntry($_GET["id"]);

            // Aufbereitung der Daten fuer die Ausgabe (View)
            $_SESSION["message"] = "delete_entry";
        } catch (MissingEntryException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleMissingEntryException();
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $this->handleInternalErrorException();
        }
    }
    public function updateEntry()
    {
        $this->checkCSRF();
        // Überprüfung der erforderlichen Parameter
        $this->checkEntryRequiredParam();

        try {
            // Aufbereitung der Daten für die Kontaktierung des Modells
            $id = intval($_POST["id"]);

            // Kontaktierung des Modells (Geschäftslogik)
            $rezept = Rezept::getInstance();
            $anleitung = is_array($_POST['anleitung']) ? implode('||', $_POST['anleitung']) : $_POST['anleitung'];
            $rezept->updateEntry(
                $id,
                $_POST["titel"],
                $_POST["email"],
                $_POST["kurzbeschreibung"],
                $_POST["dauer"],
                $_POST["schwierigkeit"],
                $_POST["preis"],
                //php syntax "?=wenn die bedingung stimmt" ": else"
                // Wandelt die Zutaten- und Mengen-Arrays (wenn es arrays sind) aus dem Formular in kommaseparierte Strings um, damit sie korrekt in der Datenbank gespeichert werden
                $_POST['zutaten'] = is_array($_POST['zutaten']) ? implode(',', $_POST['zutaten']) : $_POST['zutaten'],
                $_POST['menge'] = is_array($_POST['menge']) ? implode(',', $_POST['menge']) : $_POST['menge'],
                $anleitung,
                $_POST["bild"]

            );


            // Aufbereitung der Daten für die Ausgabe (View)
            $_SESSION["message"] = "update_success";
        } catch (MissingEntryException) {
            // Behandlung von potentiellen Fehlern der Geschäftslogik
            $this->handleMissingEntryException();
        } catch (InternalErrorException) {
            // Behandlung von potentiellen Fehlern der Geschäftslogik
            $this->handleInternalErrorException();
        }

        // Aufbereitung der Daten für die Ausgabe (View)
        $_SESSION["message"] = "update_success";
    }

    private function checkCSRF(){
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die("CSRF-Angriff erkannt!");
        }
    }
}
