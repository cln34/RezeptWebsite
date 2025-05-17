<?php
require_once "php/model/RezeptEintrag.php";
require_once "php/model/RezeptDAO.php";

class RezeptSession implements RezeptDAO
{

	private static $instance = null;
	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new RezeptSession();
		}

		return self::$instance;
	}
	private $entries = array();

	private function __construct()
	{
		if (isset($_SESSION["entries"])) {
			$this->entries = unserialize($_SESSION["entries"]);
		} else {
			//nur zu Testzwecken
			$this->entries[0] = new RezeptEintrag(
				0,
				"Spaghetti Bolognese",
				"max.mustermann@test.de",
				"Klassische italienische Pasta mit würziger Fleischsoße.",
				"30 Minuten",
				"Einfach",
				"5€",
				"Nudeln, Hackfleisch, Tomaten, Zwiebeln, Knoblauch, Gewürze",
				"Zwiebeln und Knoblauch anbraten, Hackfleisch dazugeben, Tomaten und Gewürze hinzufügen, köcheln lassen, mit Nudeln servieren.",
				"Bolognese.jpg"
			);
			$this->entries[1] = new RezeptEintrag(
				1,
				"pizza",
				"julia.schmidt@test.de",
				"Leckere pizza",
				"45 Minuten",
				"Mittel",
				"7€",
				"Nudeln, Zucchini, Aubergine, Tomaten, Käse, Gewürze",
				"Gemüse schneiden und anbraten, Tomatensoße zubereiten, alles schichten, mit Käse bestreuen und backen.",
				"pizza.jpg"
			);
			$_SESSION["entries"] = serialize($this->entries);
			$_SESSION["nextId"] = 2;
		}
	}


	public function createEntry($titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild)
	{
		$this->entries[$_SESSION["nextId"]] = new RezeptEintrag($_SESSION["nextId"], $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild);
		$_SESSION["nextId"] = $_SESSION["nextId"] + 1;
		$_SESSION["entries"] = serialize($this->entries);
	}

	public function readEntry($id)
	{
		// TODO: Implement readEntry() method.
	}

	public function updateEntry($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild)
	{
		// TODO: Implement updateEntry() method.
	}

	public function deleteEntry($id)
	{
		// TODO: Implement deleteEntry() method.
	}

	public function getEntries()
	{
		return $this->entries;
	}
}
