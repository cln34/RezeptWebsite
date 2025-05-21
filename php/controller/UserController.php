<?php
require_once "php/model/userEintrag.php";
require_once "php/model/User.php";

class UserController
{
    //erzeugt einen neuen User
    public function createUser()
    {
        //überprüft parameter
        $this->checkUserRequiredParam();

        try {
            // Aufbereitung der Daten fuer die Kontaktierung des Models

            // Kontaktierung des Models (Geschaeftslogik)
            $user = User::getInstance();
            $user->createUser(
                $_POST["email"],
                $_POST["passwort"],
            );

            // Aufbereitung der Daten fuer die Ausgabe (View)
            $_SESSION["message"] = "new_user";
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
            $user = User::getInstance();
            $users = $user->getUsers();

            // Aufbereitung der Daten fuer die Ausgabe (View), Hinweis: in diesem Fall nichts zu tun
            return $users;
        } catch (InternalErrorException $exc) {
            // Behandlung von potentiellen Fehlern der Geschaeftslogik
            $_SESSION["message"] = "internal_error";
        }
    }

    public function deleteUser()
    {
        //toDo
    }

     private function checkUserRequiredParam() {
        if (!isset($_POST["email"]) || !isset($_POST["passwort"]) || !isset($_POST["passwortWDH"])) {
            // Behandlung von fehlenden Parametern
            $_SESSION["message"] = "missing_required_parameters";
            header("Location: registrierung.php");
            exit;
        }
        if ($_POST["passwort"] !== $_POST["passwortWDH"]) {
            // Behandlung von nicht übereinstimmenden Passwörtern
            $_SESSION["message"] = "passwords_do_not_match";
            header("Location: registrierung.php");
            exit;
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
}