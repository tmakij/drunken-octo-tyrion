<?php

require_once 'libs/models/idobject.php';
require_once 'libs/tietokantayhteys.php';

final class Kayttaja extends IDobject {

    private $nimi;
    private $salasana;
    private $ryhma;

    public static function haeKayttajaID($id) {
        $tulos = querySingle('SELECT id, nimi, ryhma FROM kayttaja WHERE id = ?', array($id));
        $kayttaja = new Kayttaja();
        $kayttaja->id = $tulos->id;
        $kayttaja->nimi = $tulos->nimi;
        $kayttaja->ryhma = $tulos->ryhma;
        $kayttaja->salasana = null;
        return $kayttaja;
    }

    public static function haeKayttaja($nimi, $salasana) {
        $tulos = querySingle('SELECT id, nimi, salasana, ryhma FROM kayttaja WHERE nimi = ? AND salasana = ?', array($nimi, $salasana));
        $kayttaja = new Kayttaja();
        $kayttaja->id = $tulos->id;
        $kayttaja->nimi = $tulos->nimi;
        $kayttaja->salasana = $tulos->salasana;
        $kayttaja->ryhma = $tulos->ryhma;
        return $kayttaja;
    }

    public function getRyhma() {
        return $this->ryhma;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setRyhma($ryhma) {
        $this->ryhma = $ryhma;
    }

    public function __toString() {
        return $this->nimi;
    }

}
