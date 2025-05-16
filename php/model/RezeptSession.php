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

	public function createEntry($title, $email, $text) {
		// TODO: Implement createEntry() method.
	}

	public function readEntry($id) {
		// TODO: Implement readEntry() method.
	}

	public function updateEntry($id, $title, $email, $text) {
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