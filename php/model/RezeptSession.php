<?php
class RezeptSession implements RezeptDAO{

    private static $instance = null;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new RezeptSession();
        }

        return self::$instance;
    }
    private $entries = array();

	private function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION["entries"])) {
            $this->entries = unserialize($_SESSION["entries"]);
        } else {
            // Beispiel-Daten zum Testen
            $this->entries[0] = new RezeptEintrag(0, "Spaghetti Carbonara", "koch@example.com", "Leckere Pasta", 30, "Mittel", "Günstig", "Spaghetti, Eier, Speck", "Kochen & mischen", "bild1.jpg");
            $this->entries[1] = new RezeptEintrag(1, "Pfannkuchen", "backen@example.com", "Schneller Snack", 20, "Einfach", "Sehr günstig", "Mehl, Eier, Milch", "Alles verrühren und braten", "bild2.jpg");
            $_SESSION["entries"] = serialize($this->entries);
            $_SESSION["nextId"] = 2;
        }
    }

	public function createEntry($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild) {
        $this->entries[$_SESSION["nextId"]] = new RezeptEintrag($_SESSION["nextId"], $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild);
        $_SESSION["nextId"] = $_SESSION["nextId"] + 1;
        $_SESSION["entries"] = serialize($this->entries);
	}

	   public function readEntry($id) {
        foreach ($this->entries as $entry) {
            if ($entry->getId() == $id) {
                return $entry;
            }
        }
        throw new Exception("Eintrag mit ID $id nicht gefunden.");
    }

	public function updateEntry($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild) {
		 foreach ($this->entries as $entry) {
            if ($entry->getId() == $id) {
                // Neue RezeptEintrag-Instanz oder eine update-Methode?
                $this->entries[$id] = new RezeptEintrag($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild);
                $_SESSION["entries"] = serialize($this->entries);
                return $this->entries[$id];
            }
        }
        throw new Exception("Eintrag mit ID $id nicht gefunden.");
	}

	public function deleteEntry($id) {
		if (isset($this->entries[$id])) {
            unset($this->entries[$id]);
            $this->entries = array_values($this->entries); // Reindizieren
            $_SESSION["entries"] = serialize($this->entries);
        } else {
            throw new Exception("Eintrag mit ID $id existiert nicht.");
        }
	}

	 public function getEntries() {
        return $this->entries;
    }

}
?>