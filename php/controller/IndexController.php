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
}
