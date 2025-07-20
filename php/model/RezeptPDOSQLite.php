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
            $sql = "INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild, datum)
                VALUES (:titel, :email, :kurzbeschreibung, :dauer, :schwierigkeit, :preis, :zutaten, :menge, :anleitung, :bild, :datum);";
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
            ":bild" => $bild,
            ":datum" => date("Y-m-d H:i:s")
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
        try {
            $db = $this->getConnection();
            $db->beginTransaction();
            // Prüfen, ob der Eintrag existiert
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
            if (empty($bild)) {
                $sql = "SELECT bild FROM rezept WHERE id = :id LIMIT 1";
                $command = $db->prepare($sql);
                $command->execute([":id" => $id]);
                $result = $command->fetch();
                $bild = $result["bild"];
            }
            if (empty($email)) {
                $sql = "SELECT email FROM rezept WHERE id = :id LIMIT 1";
                $command = $db->prepare($sql);
                $command->execute([":id" => $id]);
                $result = $command->fetch();
                $email = $result["email"];
            }

            // Update durchführen
            $sql = "UPDATE rezept SET
                titel = :titel,
                email = :email,
                kurzbeschreibung = :kurzbeschreibung,
                dauer = :dauer,
                schwierigkeit = :schwierigkeit,
                preis = :preis,
                zutaten = :zutaten,
                menge = :menge,
                anleitung = :anleitung,
                bild = :bild
                WHERE id = :id";
            $command = $db->prepare($sql);
            if (!$command) {
                $db->rollBack();
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
                ":bild" => $bild,
                ":id" => $id
            ])) {
                $db->rollBack();
                throw new InternalErrorException();
            }
            $db->commit();
        } catch (PDOException $exc) {
            if (isset($db)) {
                $db->rollBack();
            }
            throw new InternalErrorException();
        }
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
            $entry["bild"],
            $entry["datum"]
        );
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
                    $row["bild"],
                    $row["datum"]
                );
                $entries[] = $entry;
            }
            return $entries;
        } catch (PDOException $exc) {
            throw new InternalErrorException();
        }
    }

    // Methoden für Favoriten
    public function addFavorit($benutzer_id, $rezept_id) {
        $db = $this->getConnection();
        $stmt = $db->prepare("INSERT INTO favoriten (benutzer_id, rezept_id) VALUES (?, ?)");
        $stmt->execute([$benutzer_id, $rezept_id]);
    }

    public function removeFavorit($benutzer_id, $rezept_id) {
        $db = $this->getConnection();
        $stmt = $db->prepare("DELETE FROM favoriten WHERE benutzer_id = ? AND rezept_id = ?");
        $stmt->execute([$benutzer_id, $rezept_id]);
    }

    public function isFavorit($benutzer_id, $rezept_id) {
        $db = $this->getConnection();
        $stmt = $db->prepare("SELECT 1 FROM favoriten WHERE benutzer_id = ? AND rezept_id = ?");
        $stmt->execute([$benutzer_id, $rezept_id]);
        return $stmt->fetch() !== false;
    }

    public function getFavoriten($benutzer_id) {
        $db = $this->getConnection();
        $stmt = $db->prepare("SELECT rezept_id FROM favoriten WHERE benutzer_id = ?");
        $stmt->execute([$benutzer_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
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
                        bild BLOB,
                        datum text
                    );"); //bei bild muss entweder ein Pfad oder ein Blob rein

                    $bildPizza = file_exists('images/pizza.jpg') ? file_get_contents('images/pizza.jpg') : null;
                    $bildPasta = file_exists('images/Bolognese.jpg') ? file_get_contents('images/Bolognese.jpg') : null;
                    $bildPesto = file_exists('images/Pesto.jpg') ? file_get_contents('images/Pesto.jpg') : null;

                    $stmt = $db->prepare("
                        INSERT INTO rezept (titel, email, kurzbeschreibung, dauer, schwierigkeit, preis, zutaten, menge, anleitung, bild, datum)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");

            $stmt->execute([
                'Pizza Margherita',
                'pizza@beispiel.de',
                'Klassische italienische Pizza mit Tomate und Mozzarella.',
                20,
                'Einfach',
                4.00,
                implode('||', ['Hefe', 'Mehl', 'Wasser', 'Tomatensauce', 'Mozzarella', 'Basilikum']),
                implode('||', ['20g', '500g', '250ml', '100ml', '100g', '1 Bund']),
                implode('||', [
                    'Teig aus Hefe, Mehl und Wasser kneten und 1 Tag ruhen lassen',
                    'Teig ausrollen und mit Tomatensauce bestreichen',
                    'Mozzarella darauf verteilen',
                    'Backen bei 250 Grad',
                    'Mit Basilikum garnieren'
                ]),
                $bildPizza,
                '2024-01-01 12:00:00'
            ]);

            $stmt->execute([
                'Spaghetti Bolognese',
                'bolognese@beispiel.de',
                'Schnelle Spaghetti mit würziger Hackfleischsoße.',
                25,
                'Einfach',
                5.00,
                implode('||', ['Spaghetti', 'Hackfleisch', 'Tomaten', 'Zwiebel', 'Knoblauch']),
                implode('||', ['200g', '150g', '200g', '1', '1 Zehe']),
                implode('||', [
                    'Spaghetti kochen',
                    'Hackfleisch mit Zwiebel und Knoblauch anbraten',
                    'Tomaten zugeben',
                    'Köcheln lassen',
                    'Mit Spaghetti servieren'
                ]),
                $bildPasta,
                '2024-01-02 13:00:00'
            ]);

            $stmt->execute([
                'Pesto alla Genovese',
                'pesto@beispiel.de',
                'Frisches Basilikumpesto für Pasta oder Brot.',
                10,
                'Einfach',
                3.00,
                implode('||', ['Basilikum', 'Pinienkerne', 'Parmesan', 'Olivenöl', 'Knoblauch']),
                implode('||', ['1 Bund', '30g', '30g', '50ml', '1 Zehe']),
                implode('||', [
                    'Alle Zutaten im Mörser oder Mixer fein zerkleinern',
                    'Mit Öl vermengen'
                ]),
                $bildPesto,
                '2024-01-03 14:00:00'
            ]);

            // Tabelle für Favoriten erstellen
            $db->exec("
                CREATE TABLE favoriten (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    benutzer_id INTEGER NOT NULL,
                    rezept_id INTEGER NOT NULL,
                    FOREIGN KEY (benutzer_id) REFERENCES user(id) ON DELETE CASCADE,
                    FOREIGN KEY (rezept_id) REFERENCES rezept(id) ON DELETE CASCADE
                );
            ");

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
                    $row["bild"],
                    $row["datum"]
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
