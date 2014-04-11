<?php

require_once 'libs/models/idobject.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/groups/ryhma.php';

final class Kayttaja extends IDobject {

    private $nimi;
    private $salasana;
    private $ryhma;

    function __construct($id, $nimi, $salasana, $ryhma) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->salasana = $salasana;
        $this->ryhma = $ryhma;
    }

    public static function uusiKayttaja($nimi, $salasana) {
        try {
            queryArray('SELECT nimi FROM kayttaja WHERE nimi = ?', array($nimi));
        } catch (DataBaseException $ex) { //Lopputulos oli tyhjä, eli samannimsiä käytäjiä ei ole.
            tallennaTietokantaan('INSERT INTO kayttaja (nimi, salasana, ryhma) VALUES (?, ?, ' . Rekisteroitynyt . ')'
                    , array($nimi, $salasana));
            return true;
        }
        return false;
    }

    public static function haeKayttajaID($id) {
        $tulos = querySingle('SELECT id, nimi, ryhma FROM kayttaja WHERE id = ?', array($id));
        $kayttaja = new Kayttaja($tulos->id, $tulos->nimi, null, $tulos->ryhma);
        return $kayttaja;
    }

    public static function haeKayttaja($nimi, $salasana) {
        $tulos = querySingle('SELECT id, nimi, salasana, ryhma FROM kayttaja WHERE nimi = ? AND salasana = ?', array($nimi, $salasana));
        $kayttaja = new Kayttaja($tulos->id, $tulos->nimi, $tulos->salasana, $tulos->ryhma);
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
