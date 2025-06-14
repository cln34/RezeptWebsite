<?php
class KommentarEintrag{
    private $id;
    private $email;
    private $inhalt;
    private $sterneBewertung;
   private $datum; 

    public function __construct($id, $email, $inhalt, $sterneBewertung, $datum)
    {
        $this->id = $id;
        $this->email = $email;
        $this->inhalt = $inhalt;
        $this->sterneBewertung = $sterneBewertung;
        $this->datum = $datum;
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
    public function getDatum()
    {
        return $this->datum;
    }
}
?>