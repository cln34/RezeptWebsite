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

    public function __construct($id, $titel, $email, $kurzbeschreibung, $dauer, $schwierigkeit, $preis, $zutaten, $menge, $anleitung, $bild)
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
}
