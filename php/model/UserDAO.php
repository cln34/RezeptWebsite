<?php

class InternalErrorException extends Exception {}
class MissingEntryException extends Exception {}
interface UserDAO
{
	
	public function createUser($email, $passwort);

	
	public function readUser($id);

	
	public function updateUser($id, $email, $passwort, $rolle);

	
	public function deleteUser($id);


	public function getUsers();
}
