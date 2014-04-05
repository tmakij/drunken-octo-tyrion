<?php

require_once 'libs/models/idobject.php';
require_once 'libs/models/viesti.php';

final class Viestiketju extends IDobject {

    private $otsikko;
    private $aihe;
    private $viestit;

    public static function getKetju($id) {
        $tulos = querySingle('SELECT id, otsikko, aihe FROM viestiketju where id = ?', array($id));
        $ketju = new Viestiketju();
        $ketju->id = $tulos->id;
        $ketju->otsikko = $tulos->otsikko;
        $ketju->aihe = $tulos->aihe;
        $ketju->viestit = Viesti::getViestitKetjusta($ketju->id);
        return $ketju;
    }

    public static function getKetjut() {
        $tulos = queryArray('SELECT id, otsikko, aihe FROM viestiketju', array());
        $ketjut = array();
        foreach ($tulos as $ketjuTulos) {
            $ketju = new Viestiketju();
            $ketju->id = $ketjuTulos->id;
            $ketju->otsikko = $ketjuTulos->otsikko;
            $ketju->aihe = $ketjuTulos->aihe;
            $ketju->viestit = Viesti::getViestitKetjusta($ketju->id);
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
        $kysely = tallennaTietokantaan('INSERT INTO viestiketju(otsikko, aihe) VALUES(?, ?) RETURNING ID', array($otsikko, $aihe));
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
