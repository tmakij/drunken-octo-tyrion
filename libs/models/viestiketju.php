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
        $ketjut = array();
        $maara = queryMaara('SELECT COUNT(*) as cnt FROM viestiketju', array()) + 1; //IDt alkavat 1:stä
        for ($i = 1; $i < $maara; $i++) {
            array_push($ketjut, self::getKetju($i));
        }
        return $ketjut;
    }

    public static function luoKetju($otsikko, $aihe, $sisalto, $kayttajaID) {
        $id = tallennaTietokantaan('INSERT INTO viestiketju VALUES (?, ?) RETURNIN ID', array($otsikko, $aihe))->fetchColumn();
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
        return reset($this->viestit)->getAika();
    }

    public function getViimeisin() {
        $last = end($this->viestit);
        reset($this->viestit);
        return $last->getKirjoittaja();
    }

}
