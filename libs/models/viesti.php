<?php

require_once 'libs/models/idobject.php';
require_once 'libs/models/kayttaja.php';

final class Viesti extends IDobject {

    private $kirjoittaja;
    private $sisalto;
    private $aika;

    private function __construct($id, $kirjoittaja, $sisalto, $aika) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->sisalto = $sisalto;
        $this->aika = $aika;
    }

    private static function rakennaArraysta($viestitRaw) {
        $viestit = array();
        foreach ($viestitRaw as $rivi) {
            $viesti = new Viesti($rivi->id, $rivi->kirjoittaja, $rivi->sisalto, $rivi->aika);
            array_push($viestit, $viesti);
        }
        return $viestit;
    }

    public static function getViestitKetjusta($ketju) {
        $tulos = queryArray('SELECT id, kirjoittaja, sisalto, aika FROM viesti WHERE viestiketju = ?', array($ketju));
        $viestit = self::rakennaArraysta($tulos);
        uasort($viestit, function ($a, $b) {
            return $a->getAika() > $b->getAika() ? 1 : -1;
        });
        return $viestit;
    }

    //. '(SELECT id FROM viestiketju WHERE viesti.viestiketju = viestiketju.id and viestiketju.aihe = ?) as ViestiKetjuAihe '
    public static function getTietytViestit($kayttajaNimi, $aihe, $aikaAlku, $aikaLoppu) {
        $tulos = queryArray('SELECT viesti.id, kirjoittaja, sisalto, aika FROM viesti, viestiketju, '
                . '(SELECT id FROM kayttaja WHERE lower(nimi) LIKE (lower(\'%\' || ? || \'%\'))) AS KayttajaID '
                . 'WHERE kirjoittaja = KayttajaID.id AND viestiketju.id = viesti.viestiketju AND viestiketju.aihe = ?'
                . ' AND aika BETWEEN ? AND ? ORDER BY aika'
                , array($kayttajaNimi, $aihe, $aikaAlku, $aikaLoppu));
        return self::rakennaArraysta($tulos);
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
