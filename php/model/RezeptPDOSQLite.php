<?php
require_once "RezeptDAO.php";
require_once "RezeptEintrag.php";

class RezeptPDOSQLite implements RezeptDAO
{
    private static $instance = null;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new RezeptPDOSQLite();
        }
        return self::$instance;
    }

    public function createEntry($titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild)
    {
        try {
            $db = $this->getConnection();
            $sql = "INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) 
                VALUES (:titel, :email, :kurzbeschreibung, :dauer, :schwierigkeit, :preis, :zutaten, :menge, :anleitung, 'pizza.jpg');";
            $command = $db->prepare($sql);
            if (!$command) {
            throw new InternalErrorException();
            }
            if (!$command->execute([
            ":titel" => $titel,
            ":email" => $email,
            ":kurzbeschreibung" => $kurzbeschreibung,
            ":dauer" => $dauer,
            ":schwierigkeit" => $schwierigkeit,
            ":preis" => $preis,
            ":zutaten" => $zutaten,
            ":menge" => $menge,
            ":anleitung" => $anleitung,
            // ":bild" => $bild
            ])) {
            throw new InternalErrorException();
            }
            return intval($db->lastInsertId());
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
        
    }


    public function readEntry($id){
        try{
            $db = $this->getConnection();
            return $this->getEntry($id, $db);

        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }

    }

    public function updateEntry($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild){

    }

   
    public function deleteEntry($id){
        try {
            $db = $this->getConnection();
            $db->beginTransaction();
            $sql = "SELECT * FROM rezept WHERE id=:id LIMIT 1";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            if (!$command->execute([":id" => $id])) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            $result = $command->fetchAll();
            if (empty($result)) {
                $db->rollBack();
                throw new MissingEntryException();
            }
            $sql = "DELETE FROM rezept WHERE id=:id";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            if (!$command->execute([":id" => $id])) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            $db->commit();
        } catch (PDOException $exc) {
            $db->rollBack();
            throw new InternalErrorException();
        }
    }

    public function getEntry($id, $db){
        try {
            $sql = "SELECT * FROM rezept WHERE id=:id LIMIT 1";
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
            $entry = $result[0];
            return new RezeptEintrag(
            $entry["id"],
            $entry["titel"],
            $entry["email"],
            $entry["kurzbeschreibung"],
            $entry["dauer"],
            $entry["schwierigkeit"],
            $entry["preis"],
            $entry["zutaten"],
            $entry["menge"],
            $entry["anleitung"],
            $entry["bild"]);
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }

   
    public function getEntries(){
        try {
            $db = $this->getConnection();
            $sql = "SELECT * FROM rezept";
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
                $entry = new RezeptEintrag(
                    $row["id"],
                    $row["titel"],
                    $row["email"],
                    $row["kurzbeschreibung"],
                    $row["dauer"],
                    $row["schwierigkeit"],
                    $row["preis"],
                    $row["zutaten"],
                    $row["menge"],
                    $row["anleitung"],
                    $row["bild"]);
                $entries[] = $entry;
            }
            return $entries;
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }

    private function getConnection()
    {
       
        if (!file_exists("db/rezept.db")) {
            $this->create();
        }

        try {
            $user = 'root';
            $pw = null;
            $dsn = 'sqlite:db/rezept.db';
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
            $dsn = 'sqlite:db/rezept.db';
            $db = new PDO($dsn, $user, $pw);

            $db->exec("
                    CREATE TABLE rezept (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        titel TEXT,
                        email TEXT,
                        kurzbeschreibung TEXT,
                        dauer INTEGER,
                        schwierigkeit TEXT,
                        preis REAL,
                        zutaten TEXT,
                        menge TEXT,
                        anleitung TEXT,
                        bild TEXT 
                    );");//bei bild muss entweder ein Pfad oder ein Blob rein
            $db->exec("
                INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) VALUES
                    ('Überschrift 1', 'test1@test.de', 'Kurze Beschreibung 1', 30, 'Einfach', 5.99, 'Zutat1, Zutat2', '2, 3', 'Anleitung 1', 'bild1.jpg')
                ;");
            $db->exec("
                INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) VALUES
                    ('Überschrift 2', 'test2@test.de', 'Kurze Beschreibung 2', 45, 'Mittel', 8.50, 'Zutat3, Zutat4', '1, 4', 'Anleitung 2', 'bild2.jpg')
                ;");
            $db->exec("
                INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) VALUES
                    ('Überschrift 3', 'test3@test.de', 'Kurze Beschreibung 3', 60, 'Schwer', 12.00, 'Zutat5, Zutat6', '5, 2', 'Anleitung 3', 'bild3.jpg')
                ;");

            unset($db);
        } catch (PDOException $e) {
            // nothing
        }
    }
}
