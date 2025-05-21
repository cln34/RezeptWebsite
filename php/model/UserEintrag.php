<?php
class UserEintrag
{
    private $id;
    private $email;
    private $password;
    private $rolle;

    public function __construct($id, $email, $password, $rolle)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->rolle = $rolle;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRolle()
    {
        return $this->rolle;
    }

}