<?php
require_once "php/model/UserEintrag.php";
require_once "php/model/UserDAO.php";

class UserSession implements UserDAO
{
	private static $instance = null;
	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new UserSession();
		}

		return self::$instance;
	}
	private $users = array();

    private function __construct()
    {
        if (isset($_SESSION["users"])) {
			$this->users = unserialize($_SESSION["users"]);
		} else {
            $this->users[0] = new UserEintrag(0, "colin@uol.de", password_hash("pass123", PASSWORD_DEFAULT), "Admin");
            $this->users[1] = new UserEintrag(1, "sascha@uol.de", password_hash("geheim", PASSWORD_DEFAULT), "User");
            $this->users[2] = new UserEintrag(2, "christoph@uol.de", password_hash("1234", PASSWORD_DEFAULT), "User");

            $_SESSION["users"] = serialize($this->users);
            $_SESSION["nextId"] = 2;
        }
    }

    public function createUser($email, $password)
    {
        $this->users[$_SESSION["nextId"]] = new UserEintrag($_SESSION["nextId"], $email, password_hash($password, PASSWORD_DEFAULT), "User");
        $_SESSION["nextId"] = $_SESSION["nextId"] + 1;
        $_SESSION["users"] = serialize($this->users);
    }

    public function readUser($id)
    {
        if (isset($this->users[$id])) {
            return $this->users[$id];
        } else {
            throw new MissingEntryException("User not found");
        }
    }

    public function updateUser($id, $email, $password, $role)
    {
       // ToDo
    }

    public function deleteUser($id)
    {
        if (isset($this->users[$id])) {
            unset($this->users[$id]);
            $_SESSION["users"] = serialize($this->users);
        } else {
            throw new MissingEntryException("User not found");
        }
    }

    public function getUsers()
    {
        return $this->users;
    }
}