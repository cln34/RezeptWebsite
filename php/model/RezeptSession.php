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
	private $searchEntries = array();

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
				"200gr",
				"Zwiebeln und Knoblauch anbraten, Hackfleisch dazugeben, Tomaten und Gewürze hinzufügen, köcheln lassen, mit Nudeln servieren.",
				"Bolognese.jpg",
				"2023-10-01 12:00:00",
			);
			$this->entries[1] = new RezeptEintrag(
				1,
				"Pizza",
				"julia.schmidt@test.de",
				"Leckere pizza",
				"45 Minuten",
				"Mittel",
				"7€",
				"Nudeln, Zucchini, Aubergine, Tomaten, Käse, Gewürze",
				"500gr",
				"Gemüse schneiden und anbraten, Tomatensoße zubereiten, alles schichten, mit Käse bestreuen und backen.",
				"pizza.jpg",
				"2023-10-02 14:30:00",
			);
			$_SESSION["entries"] = serialize($this->entries);
			$_SESSION["nextId"] = 2;
		}
	}


	public function createEntry($titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild)
	{
		$this->entries[$_SESSION["nextId"]] = new RezeptEintrag($_SESSION["nextId"], $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $menge, $zutaten, $anleitung, $bild, date("Y-m-d H:i:s"));
		$_SESSION["nextId"] = $_SESSION["nextId"] + 1;
		$_SESSION["entries"] = serialize($this->entries);
	}

	public function readEntry($id)
	{
		foreach ($this->entries as $entry) {
			if ($entry->getId() == $id) {
				return $entry;
			}
		}
		throw new MissingEntryException();
	}

	public function updateEntry($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild)
	{
		foreach ($this->entries as $entry) {
			if ($entry->getId() == $id) {
				$entry->setTitel($titel);
				$entry->setEmail($email);
				$entry->setKurzbeschreibung($kurzbeschreibung);
				$entry->setDauer($dauer);
				$entry->setSchwierigkeit($schwierigkeit);
				$entry->setPreis($preis);
				$entry->setZutaten($zutaten);
				$entry->setMenge($menge);
				$entry->setAnleitung($anleitung);
				$entry->setBild($bild);
				break;
			}
		
		}

		$_SESSION["entries"] = serialize($this->entries);
		$_SESSION["message"] = "Rezept erfolgreich aktualisiert!";
	}

	public function deleteEntry($id)
	{
		foreach ($this->entries as $key => $entry) {
			if ($entry->getId() == $id) {
				unset($this->entries[$key]);
				$this->entries = array_values($this->entries);
				$_SESSION["entries"] = serialize($this->entries);
				return;
			}
		}
	}

	public function getEntries()
	{
		return $this->entries;
	}

	//Methode um die Suche durchzuführen, vergleicht die sucheingabe mit dem Titel der Rezepte und speichert nur
	//die gefundenen Rezepte in dem searchEntries array
	public function searchForEntry($sucheingabe)
	{
		$this->searchEntries = []; // Suchergebnisse zurücksetzen
		foreach ($this->entries as $entry) {
			if (stripos($entry->getTitel(), $sucheingabe) !== false) { // Titel enthält Suchbegriff
				$this->searchEntries[] = $entry;
			}
		}
	}
	//Methode um die Suchergebnisse zurückzugeben: wird im indexcontroller verwendet um die index seite nur mit den
	//gefundenen Rezepten zu laden
	public function getSearchEntries()
	{
		if (empty($this->searchEntries)) {
			return null; // Keine Suchergebnisse gefunden
		} else{
			return $this->searchEntries;}
		
	}
}
