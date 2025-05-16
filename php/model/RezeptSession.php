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

	public function createEntry($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild) {
        $this->entries[$_SESSION["nextId"]] = new RezeptEintrag($_SESSION["nextId"], $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild);
        $_SESSION["nextId"] = $_SESSION["nextId"] + 1;
        $_SESSION["entries"] = serialize($this->entries);
	}

	public function readEntry($id) {
		// TODO: Implement readEntry() method.
	}

	public function updateEntry($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild) {
		// TODO: Implement updateEntry() method.
	}

	public function deleteEntry($id) {
		// TODO: Implement deleteEntry() method.
	}

	public function getEntries() {
		// TODO: Implement getEntries() method.
	}

}
?>