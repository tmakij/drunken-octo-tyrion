<?php

require_once 'libs/models/idobject.php';
require_once 'libs/models/kayttaja.php';

final class Viesti extends IDobject {

    private $kirjoittaja;
    private $sisalto;
    private $aika;

    public function __construct($id, $kirjoittaja, $sisalto, $aika) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->sisalto = $sisalto;
        $this->aika = $aika;
    }

    public static function getViestitKetjusta($ketju) {
        $tulos = queryArray('SELECT id, kirjoittaja, sisalto, aika FROM viesti where viestiketju = ?', array($ketju));
        $viestit = array();
        foreach ($tulos as $rivi) {
            $viesti = new Viesti($rivi->id, $rivi->kirjoittaja, $rivi->sisalto, $rivi->aika);
            array_push($viestit, $viesti);
        }
        uasort($viestit, function ($a, $b) {
            return $a->getAika() > $b->getAika() ? 1 : -1;
        });
        return $viestit;
    }

    public static function uusiViesti($ketju, $sisalto, $kayttaja) {
        tallennaTietokantaan('INSERT INTO viesti (sisalto, aika, kirjoittaja, viestiketju) VALUES (?, current_timestamp, ?, ?)'
                , array($sisalto, $kayttaja, $ketju));
    }

    public function getKirjoittaja() {
        return Kayttaja::haeKayttajaID($this->kirjoittaja);
    }

    public function getSisalto() {
        return $this->sisalto;
    }

    public function getAika() {
        return $this->aika;
    }

}
