<?php
require_once "KommentarDAO.php";
require_once "KommentarEintrag.php";

class KommentarPDOSQLite implements KommentarDAO
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new KommentarPDOSQLite();
        }
        return self::$instance; //self instance wenn statisch. this->instance wenn nicht statisch
    }


    public function createComment($rezept_id, $email, $inhalt, $sterneBewertung)
    {
        try {
            $db = $this->getConnection();
            $db->beginTransaction();
            $sql = "INSERT INTO kommentar(rezept_id, email, inhalt, sterneBewertung) VALUES (:rezept_id, :email, :inhalt, :sterneBewertung);";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            if (!$command->execute([
                ":rezept_id" => $rezept_id,
                ":email" => $email,
                ":inhalt" => $inhalt,
                ":sterneBewertung" => $sterneBewertung
            ])) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            $lastId = intval($db->lastInsertId());
            $db->commit();
            return $lastId;
        } catch (PDOException $e) {
             $db->rollBack();
            throw new InternalErrorException();
        }
    }


    public function readComment($id)
    {
        try {
            $db = $this->getConnection();
            return $this->getComment($id, $db);
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }


    public function getCommentsByRezeptId($rezeptId)
    {
        try {
            $db = $this->getConnection();
            $sql = "SELECT * FROM kommentar WHERE rezept_id = :rezept_id";
            $command = $db->prepare($sql);
            if (!$command) {
                throw new InternalErrorException();
            }
            if (!$command->execute([":rezept_id" => $rezeptId])) {
                throw new InternalErrorException();
            }
            $result = $command->fetchAll();

            $comments = [];
            foreach ($result as $row) {
                $comment = new KommentarEintrag(
                    $row["kommentar_id"],
                    $row["email"],
                    $row["inhalt"],
                    $row["sterneBewertung"],
                    $row["datum"]
                );
                $comments[] = $comment;
            }
            return $comments;
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }

    public function getComment($id, $db)
    {
        try {
            $sql = "SELECT * FROM kommentar WHERE id=:id LIMIT 1";
            $command = $db->prepare($sql);
            if (!$command) {
                throw new InternalErrorException();
            }
            if (!$command->execute([":id" => $id])) {
                throw new InternalErrorException();
            }
            $result = $command->fetchAll();
            if (empty($result)) {
                throw new MissingEntryException();
            }
            $comment = $result[0];
            return new Kommentar($comment["id"], $comment["email"], $comment["inhalt"], $comment["sterneBewertung"]);
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
            $db->exec("PRAGMA foreign_keys = ON;"); // Fremdschlüssel aktivieren!
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
            $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='kommentar';");
            if ($result && $result->fetch()) {
                // Tabelle existiert bereits, also nichts tun
                unset($db);
                return;
            }
            $db->exec("CREATE TABLE IF NOT EXISTS kommentar(
                kommentar_id INTEGER PRIMARY KEY AUTOINCREMENT,
                rezept_id INTEGER NOT NULL, --fremdschlüssel
                email TEXT NOT NULL,
                inhalt TEXT NOT NULL,
                sterneBewertung INTEGER,
                datum DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (rezept_id) REFERENCES rezept(id) ON DELETE CASCADE
            );");
            $db->exec("
             INSERT INTO kommentar (rezept_id, email, inhalt, sterneBewertung) VALUES
                 (1, 'colin@uol.de', 'Ich finde die Pizza müsste länger im Ofen sein, ansonsten sehr lecker.', 4)
             ;");
            $db->exec("
             INSERT INTO kommentar (rezept_id, email, inhalt, sterneBewertung) VALUES
                 (1, 'sascha@uol.de', 'Einfach fabelhaft!', 5)
             ;");
            $db->exec("
             INSERT INTO kommentar (rezept_id, email, inhalt, sterneBewertung) VALUES
                 (2, 'chris@uol.de', 'Geht Besser', 3)
             ;");

            unset($db);
        } catch (PDOException $e) {
            throw new InternalErrorException();
        }
    }
}
