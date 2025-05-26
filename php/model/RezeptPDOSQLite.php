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

    }

    public function updateEntry($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild){

    }

   
    public function deleteEntry($id){

    }

   
    public function getEntries(){

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
