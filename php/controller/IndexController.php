<?php
require_once "php/model/RezeptEintrag.php";
require_once  "php/model/Rezept.php";

class IndexController
{
    public function request()
    {
        // Ueberpruefung der Parameter, Hinweis: Es gibt keine Parameter
        try {

            // Aufbereitung der Daten fuer die Kontaktierung des Models
            // Hinweis: Es werden keine Daten benoetigt

            // Kontaktierung des Models (Geschaeftslogik)
            $rezept = Rezept::getInstance();
            $entries = $rezept->getEntries();

            // Aufbereitung der Daten fuer die Ausgabe (View), Hinweis: in diesem Fall nichts zu tun
            return $entries;
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $_SESSION["message"] = "internal_error";
        }
        
    }
    //Methode um die Suche zu starten, wird in der Suche.php aufgerufen
    public function requestSearchEntries($sucheingabe){
        try {

            // Kontaktierung des Models (Geschaeftslogik)
            $rezept = Rezept::getInstance();
            $rezept->searchForEntry($sucheingabe);
            $entries = $rezept->getSearchEntries();
            //wenn kein rezept gefunden wurde, wird die message gesetzt und zurück zur index.php geleitet (alle rezepte werden angezeigt)
            if ($entries == null) {
                $_SESSION["message"] = "no_entry_found";
                header("Location: index.php");
                exit();
            }else{
                return $entries;
            }
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $_SESSION["message"] = "internal_error";
            header("Location: index.php");
        }
    }
    
    
}