<?php
require_once "UserDAO.php";
require_once "UserEintrag.php";

class UserPDOSQLite implements UserDAO
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new UserPDOSQLite();
        }
        return self::$instance;
    }

    public function createUser($email, $passwort)
    {
        try {
            $db = $this->getConnection();
            $db->beginTransaction();
            $sql = "INSERT INTO user (email, passwort) VALUES (:email, :passwort);";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            if (!$command->execute([
                ":email" => $email,
                ":passwort" => $passwort
            ])) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            $lastId = intval($db->lastInsertId());
            $db->commit(); 
            return $lastId;
        } catch (PDOException $exc) {
            $db->rollBack();
            throw new InternalErrorException();
        }
    }

    public function readUser($email)
    {
        try {
            $db = $this->getConnection();
            return $this->getUser($email, $db);
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }


    public function updateUser($id, $email, $passwort, $rolle) {}

    public function deleteUser($email)
    {
        try {
            $db = $this->getConnection();
            $db->beginTransaction();

            $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            if (!$command->execute([":email" => $email])) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            $result = $command->fetch();
            if (empty($result)) {
                $db->rollBack();
                throw new MissingEntryException();
            }

            // Admin darf nicht gelöscht werden
            if ($result["rolle"] === "Admin") {
                $db->rollBack();
                throw new InternalErrorException();
            }

            $sql = "DELETE FROM user WHERE email = :email";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            if (!$command->execute([":email" => $email])) {
                $db->rollBack();
                throw new InternalErrorException();
            }

            $db->commit();
        } catch (PDOException $exc) {
            $db->rollBack();
            throw new InternalErrorException();
        }
    }

    public function getUser($email, $db)
    {
        try {
            $sql = "SELECT * FROM user WHERE email=:email LIMIT 1";
            $command = $db->prepare($sql);
            if (!$command) {
                throw new InternalErrorException();
            }
            if (!$command->execute([":email" => $email])) {
                throw new InternalErrorException();
            }
            $result = $command->fetchAll();
            if (empty($result)) {
                throw new MissingEntryException();
            }
            $entry = $result[0];
            return new UserEintrag(
                $entry["id"],
                $entry["email"],
                $entry["passwort"],
                $entry["rolle"]
            );
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }

    public function getUsers()
    {
        try {
            $db = $this->getConnection();
            $sql = "SELECT * FROM user";
            $command = $db->prepare($sql); //erstellt ein vorbereitetes sql statement, sichert gegen SQL-Injection
            if (!$command) {
                throw new InternalErrorException();
            }
            if (!$command->execute()) {
                throw new InternalErrorException();
            }
            $result = $command->fetchAll();

            $entries = [];
            foreach ($result as $row) {
                $entries[] = new UserEintrag(
                    $row["id"],
                    $row["email"],
                    $row["passwort"],
                    $row["rolle"]
                );
            }
            return $entries;
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }

    private function getConnection()
    {
        $this->create();

        try {
            $user = 'root';
            $pw = null;
            $dsn = 'sqlite:db/rezept.db';
            $db = new PDO($dsn, $user, $pw);
            $db->exec("PRAGMA foreign_keys = ON;");
            return $db;
        } catch (PDOException $e) {
            throw new InternalErrorException();
        }
    }


    private function create()
    {
        try {
            $user = 'root';
            $pw = null;
            $dsn = 'sqlite:db/rezept.db';
            $db = new PDO($dsn, $user, $pw);
            // Prüfen, ob die Tabelle bereits existiert
            $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='user';");
            if ($result && $result->fetch()) {
                // Tabelle existiert bereits, also nichts tun
                unset($db);
                return;
            }

            $db->exec("CREATE TABLE IF NOT EXISTS user (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL UNIQUE,
                passwort TEXT NOT NULL,
                rolle TEXT DEFAULT 'User'
            );");

            $db->exec("INSERT INTO user (email, passwort, rolle) VALUES ('colin@uol.de', '" . password_hash('pass123', PASSWORD_DEFAULT) . "', 'Admin');");
            $db->exec("INSERT INTO user (email, passwort, rolle) VALUES ('sascha@uol.de', '" . password_hash('geheim', PASSWORD_DEFAULT) . "', 'Admin');");
            $db->exec("INSERT INTO user (email, passwort, rolle) VALUES ('christoph@uol.de', '" . password_hash('pass123', PASSWORD_DEFAULT) . "', 'Admin');");

            $db->exec("UPDATE user SET rolle = 'Admin' WHERE email = 'colin@uol.de';");
            $db->exec("UPDATE user SET rolle = 'Admin' WHERE email = 'sascha@uol.de';");
            $db->exec("UPDATE user SET rolle = 'Admin' WHERE email = 'christoph@uol.de';");

            unset($db);
        } catch (PDOException $e) {
            throw new InternalErrorException();
        }
    }
}
