<?php
class RezeptEintrag
{
    private $id;
    private $titel;
    private $email;
    private $kurzbeschreibung;
    private $dauer;
    private $schwierigkeit;
    private $preis;
    private $zutaten = [];
    private $menge = [];
    private $anleitung;
    private $bild;

    public function __construct($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild)
    {
        $this->id = $id;
        $this->titel = $titel;
        $this->email = $email;
        $this->kurzbeschreibung = $kurzbeschreibung;
        $this->dauer = $dauer;
        $this->schwierigkeit = $schwierigkeit;
        $this->preis = $preis;
        // explode bewirkt, dass die zutaten und menge die als strings in der db gespeichert wurden, wieder zu arrays werden
        $this->zutaten = is_array($zutaten) ? $zutaten : explode(',', $zutaten);
        $this->menge = is_array($menge) ? $menge : explode(',', $menge);
        $this->anleitung = $anleitung;
        $this->bild = $bild;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getTitel()
    {
        return $this->titel;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getKurzbeschreibung()
    {
        return $this->kurzbeschreibung;
    }

    public function getDauer()
    {
        return $this->dauer;
    }

    public function getSchwierigkeit()
    {
        return $this->schwierigkeit;
    }

    public function getPreis()
    {
        return $this->preis;
    }

    public function getZutaten()
    {
        return $this->zutaten;
    }

    public function getMenge()
    {
        return $this->menge;
    }

    public function getAnleitung()
    {
        return $this->anleitung;
    }

    public function getBild()
    {
        return $this->bild;
    }


    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setKurzbeschreibung($kurzbeschreibung)
    {
        $this->kurzbeschreibung = $kurzbeschreibung;
    }

    public function setDauer($dauer)
    {
        $this->dauer = $dauer;
    }

    public function setSchwierigkeit($schwierigkeit)
    {
        $this->schwierigkeit = $schwierigkeit;
    }

    public function setPreis($preis)
    {
        $this->preis = $preis;
    }

   /*  muss man noch an arrays anpassen
   public function setZutaten($zutaten)
    {
        $this->zutaten = $zutaten;
    }

    public function setMenge($menge)
    {
        $this->menge = $menge;
    }*/

    public function setAnleitung($anleitung)
    {
        $this->anleitung = $anleitung;
    }

    public function setBild($bild)
    {
        $this->bild = $bild;
    }
}
