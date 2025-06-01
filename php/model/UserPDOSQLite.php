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
            $sql = "INSERT INTO user (email, passwort) VALUES (:email, :passwort);";
            $command = $db->prepare($sql);
            if (!$command) {
                throw new InternalErrorException();
            }
            if (!$command->execute([
                ":email" => $email,
                ":passwort" => password_hash($passwort, PASSWORD_DEFAULT)
            ])) {
                throw new InternalErrorException();
            }
            return intval($db->lastInsertId());
        } catch (PDOException $exc) {
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

    public function deleteUser($id) {}

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

        if (!file_exists("db/user.db")) {
            $this->create();
        }

        try {
            $user = 'root';
            $pw = null;
            $dsn = 'sqlite:db/user.db';
            return new PDO($dsn, $user, $pw);
        } catch (PDOException $e) {
            throw new InternalErrorException();
        }
    }


    private function create()
    {
        try {
            $user = 'root';
            $pw = null;
            $dsn = 'sqlite:db/user.db';
            $db = new PDO($dsn, $user, $pw);

            $db->exec("CREATE TABLE IF NOT EXISTS user (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL UNIQUE,
                passwort TEXT NOT NULL,
                rolle TEXT DEFAULT 'User'
            );");
            $db->exec("INSERT INTO user (email, passwort) VALUES ('colin@uol.de', '" . password_hash('pass123', PASSWORD_DEFAULT) . "');");
            $db->exec("INSERT INTO user (email, passwort) VALUES ('sascha@uol.de', '" . password_hash('geheim', PASSWORD_DEFAULT) . "');");
            $db->exec("INSERT INTO user (email, passwort) VALUES ('christoph@uol.de', '" . password_hash('pass123', PASSWORD_DEFAULT) . "');");
            unset($db);
        } catch (PDOException $e) {
            throw new InternalErrorException();
        }
    }
}
