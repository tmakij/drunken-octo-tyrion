<?php

require_once 'libs/models/idobject.php';
require_once 'libs/models/viesti.php';

final class Viestiketju extends IDobject {

    private $otsikko;
    private $aihe;
    private $viestit;

    function __construct($id, $otsikko, $aihe) {
        $this->id = $id;
        $this->otsikko = $otsikko;
        $this->aihe = $aihe;
        $this->viestit = Viesti::getViestitKetjusta($id);
    }

    public static function getKetju($id) {
        $tulos = querySingle('SELECT id, otsikko, aihe FROM viestiketju where id = ?', array($id));
        $ketju = new Viestiketju($tulos->id, $tulos->otsikko, $tulos->aihe);
        return $ketju;
    }

    public static function getKetjut() {
        $tulos = queryArray('SELECT id, otsikko, aihe FROM viestiketju', array());
        $ketjut = array();
        foreach ($tulos as $ketjuTulos) {
            $ketju = new Viestiketju($ketjuTulos->id, $ketjuTulos->otsikko, $ketjuTulos->aihe);
            array_push($ketjut, $ketju);
        }
        uasort($ketjut, function ($a, $b) {
            return $a->getAika() > $b->getAika() ? -1 : 1;
        });
        return $ketjut;
    }

    public static function poistaKetju($id) {
        tallennaTietokantaan('DELETE FROM viestiketju WHERE id = ?', array($id));
    }

    public static function paivitaKetju($id, $otsikko, $aihe) {
        tallennaTietokantaan('UPDATE viestiketju SET aihe = ?, otsikko = ? WHERE id = ?', array($aihe, $otsikko, $id));
    }

    public static function luoKetju($otsikko, $aihe, $sisalto, $kayttajaID) {
        $kysely = tallennaTietokantaan('INSERT INTO viestiketju(otsikko, aihe) VALUES(?, ?) RETURNING ID'
                , array($otsikko, $aihe));
        $id = $kysely->fetchColumn();
        Viesti::uusiViesti($id, $sisalto, $kayttajaID);
    }

    public function getOtsikko() {
        return $this->otsikko;
    }

    public function getAihe() {
        return $this->aihe;
    }

    public function getViestit() {
        return $this->viestit;
    }

    public function getAika() {
        return end($this->viestit)->getAika();
    }

    public function getViimeisin() {
        $last = end($this->viestit);
        reset($this->viestit);
        return $last->getKirjoittaja();
    }

}
