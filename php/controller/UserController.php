<?php
require_once "php/model/UserEintrag.php";
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
            $hashedPasswort = password_hash($_POST["passwort"], PASSWORD_DEFAULT);
            $user->createUser(
                $_POST["email"],
                $hashedPasswort,
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

    public function readUser($email)
    {
        if (!$email) {
            $this->handleMissingEntryException();
        }

        try {
            $user = User::getInstance();
            return $user->readUser($email);
        } catch (MissingEntryException $exc) {
            return null; // User nicht gefunden
        } catch (InternalErrorException $exc) {
            $this->handleInternalErrorException();
        }
    }

    public function deleteUser($email)
    {
        $this->checkCSRF();
        if (!$email) {
            $this->handleMissingEntryException();
        }

        try {
            // Kontaktierung des Models (Geschaeftslogik)
            $user = User::getInstance();
            $user->deleteUser($email);

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

    public function authenticateUser($email, $passwort)
    {
        $user = $this->readUser($email);
        if ($user && password_verify($passwort, $user->getPassword())) {
            return $user;
        }
        return null;
    }

    private function checkUserRequiredParam()
    {
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

    private function checkCSRF()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die("CSRF-Angriff erkannt!");
        }
    }
}
