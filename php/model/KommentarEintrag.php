<?php
class KommentarEintrag{
    private $id;
    private $email;
    private $inhalt;
    private $sterneBewertung;
   //private $datum; kann man später noch machen

    public function __construct($id, $email, $inhalt, $sterneBewertung)
    {
        $this->id = $id;
        $this->email = $email;
        $this->inhalt = $inhalt;
        $this->sterneBewertung = $sterneBewertung;
    }

    public function getID(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getInhalt(){
        return $this->inhalt;
    }

    public function getSterneBewertung(){
        return $this->sterneBewertung;
    }
}
?>