<?php
class KommentarEintrag{
    private $id;
    private $email;
    private $text;
    private $sterneBewertung;
   //private $datum; kann man später noch machen

    public function __construct($id, $email, $text, $sterneBewertung)
    {
        $this->id = $id;
        $this->email = $email;
        $this->text = $text;
        $this->sterneBewertung = $sterneBewertung;
    }

    public function getID(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getText(){
        return $this->text;
    }

    public function getSterneBewertung(){
        return $this->sterneBewertung;
    }
}
?>