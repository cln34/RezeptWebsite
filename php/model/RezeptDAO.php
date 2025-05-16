<?php
/*
* --------------------------------------------------------------------------
* Erstmal so kopiert von Musterlösung aber nach diesem DAO Konzept müssen wir arbeiten
*-----------------------------------------------------------------------------
*/

class InternalErrorException extends Exception {}
class MissingEntryException extends Exception {}
interface RezeptDAO
{
	/*
	 * Einfügen eines neuen Eintrags 
	 * return: die ID des neuen Eintrags
	 * mögliche Exceptions:
	 * InternalErrorException, wenn es einen internen Fehler gibt (bspw. beim Zugriff auf eine Datenbank)
	 */
	public function createEntry($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild);

	/*
	 * ermitteln und liefern des Eintrags mit der angegebenen ID
	 * return: Objekt der Klasse Entry
	 * mögliche Exceptions:
	 * MissingEntryException, wenn es keinen Eintrag mit der angegebenen ID gibt
	 * InternalErrorException, wenn es einen internen Fehler gibt (bspw. beim Zugriff auf eine Datenbank)
	 */
	public function readEntry($id);

	/*
	 * Ändern eines Eintrags 
	 * return: Objekt der Klasse Entry (geänderter Eintrag)
	 * mögliche Exceptions:
	 * MissingEntryException, wenn es keinen Eintrag mit der angegebenen ID gibt
	 * InternalErrorException, wenn es einen internen Fehler gibt (bspw. beim Zugriff auf eine Datenbank)
	 */
	public function updateEntry($id, $title, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $anleitung, $bild);

	/*
	 * löschen des Eintrags mit der angegebenen ID
	 * return: void
	 * mögliche Exceptions:
	 * MissingEntryException, wenn es keinen Eintrag mit der angegebenen ID gibt
	 * InternalErrorException, wenn es einen internen Fehler gibt (bspw. beim Zugriff auf eine Datenbank)
	 */
	public function deleteEntry($id);

	/*
	 * ermitteln und liefern aller Einträge
	 * return: Array mit Objekten der Klasse Eintrag; kann auch leer sein
	 * mögliche Exceptions:
	 * InternalErrorException, wenn es einen internen Fehler gibt (bspw. beim Zugriff auf eine Datenbank)
	 */
	public function getEntries();
}
