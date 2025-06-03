<?php

class InternalErrorException extends Exception {}
class MissingEntryException extends Exception {}
interface UserDAO
{
	
	public function createUser($email, $passwort);

	
	public function readUser($email);

	
	public function updateUser($id, $email, $passwort, $rolle);

	
	public function deleteUser($email);


	public function getUsers();
}
