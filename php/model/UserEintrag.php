<?php
class UserEintrag
{
    private $email;
    private $password;
    private $rolle;

    public function __construct($email, $password, $rolle)
    {
        $this->email = $email;
        $this->password = $password;
        $this->rolle = $rolle;
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