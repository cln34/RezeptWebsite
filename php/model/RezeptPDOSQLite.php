<?php
require_once "RezeptDAO.php";
require_once "RezeptEintrag.php";

class RezeptPDOSQLite implements RezeptDAO
{
    private static $instance = null;

    private $entries = array();
    private $searchEntries = array();

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
                    );"); //bei bild muss entweder ein Pfad oder ein Blob rein
            $db->exec("
                    INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) VALUES
                        ('Pizza Margherita', 'pizza@beispiel.de', 'Klassische italienische Pizza mit Tomate und Mozzarella.', 20, 'Einfach', 4.50, 'Pizzateig, Tomatensauce, Mozzarella, Basilikum', '1, 100ml, 100g, 1 Bund', 'Teig ausrollen, mit Tomatensauce bestreichen, Mozzarella darauf verteilen, backen und mit Basilikum garnieren.', 'pizza.jpg')
                ;");
            $db->exec("
                    INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) VALUES
                        ('Spaghetti Bolognese', 'bolognese@beispiel.de', 'Schnelle Spaghetti mit würziger Hackfleischsoße.', 25, 'Einfach', 5.00, 'Spaghetti, Hackfleisch, Tomaten, Zwiebel, Knoblauch', '200g, 150g, 200g, 1, 1 Zehe', 'Spaghetti kochen. Hackfleisch mit Zwiebel und Knoblauch anbraten, Tomaten zugeben, köcheln lassen. Mit Spaghetti servieren.', 'Bolognese.jpg')
                ;");
            $db->exec("
                    INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild) VALUES
                        ('Pesto alla Genovese', 'pesto@beispiel.de', 'Frisches Basilikumpesto für Pasta oder Brot.', 10, 'Einfach', 3.00, 'Basilikum, Pinienkerne, Parmesan, Olivenöl, Knoblauch', '1 Bund, 30g, 30g, 50ml, 1 Zehe', 'Alle Zutaten im Mörser oder Mixer fein zerkleinern und mit Öl vermengen.', 'Pesto.jpg')
                ;");

            unset($db);
        } catch (PDOException $e) {
            // nothing
        }
    }

    //Methode um die Suche durchzuführen, vergleicht die sucheingabe mit dem Titel der Rezepte und speichert nur
    //die gefundenen Rezepte in dem searchEntries array
    public function searchForEntry($sucheingabe)
    {
        $this->searchEntries = []; // Suchergebnisse zurücksetzen
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

            foreach ($result as $row) {
                if(stripos($row["titel"], $sucheingabe) !== false){
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
                    $row["bild"]
                );
                $this->searchEntries[] = $entry;
            }
            }

        } catch(PDOException $e){

        }
    }
    //Methode um die Suchergebnisse zurückzugeben: wird im indexcontroller verwendet um die index seite nur mit den
    //gefundenen Rezepten zu laden
    public function getSearchEntries()
    {
        if (empty($this->searchEntries)) {
            return null; // Keine Suchergebnisse gefunden
        } else {
            return $this->searchEntries;
        }
    }
}
