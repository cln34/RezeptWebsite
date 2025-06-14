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
    private $zutaten;
    private $menge;
    private $anleitung;
    private $bild;
    private $datum;

    public function __construct($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild, $datum)
    {
        $this->id = $id;
        $this->titel = $titel;
        $this->email = $email;
        $this->kurzbeschreibung = $kurzbeschreibung;
        $this->dauer = $dauer;
        $this->schwierigkeit = $schwierigkeit;
        $this->preis = $preis;
        $this->zutaten = $zutaten;
        $this->menge = $menge;
        $this->anleitung = $anleitung;
        $this->bild = $bild;
        $this->datum = $datum;
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

    public function getDatum()
    {
        return $this->datum;
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

    public function setZutaten($zutaten)
    {
        $this->zutaten = $zutaten;
    }

    public function setMenge($menge)
    {
        $this->menge = $menge;
    }

    public function setAnleitung($anleitung)
    {
        $this->anleitung = $anleitung;
    }

    public function setBild($bild)
    {
        $this->bild = $bild;
    }

    public function setDatum($datum)
    {
        $this->datum = $datum;
    }
}
