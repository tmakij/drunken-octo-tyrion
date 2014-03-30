<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/kayttajaryhma.php';

final class Kayttaja {

    private $id;
    private $nimi;
    private $salasana;
    private $ryhma;

    public static function haeKayttaja($nimi, $salasana) {
        $sql = 'SELECT id, nimi, salasana, ryhma FROM kayttaja WHERE nimi = ? AND salasana = ?';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->id = $tulos->id;
            $kayttaja->nimi = $tulos->nimi;
            $kayttaja->salasana = $tulos->salasana;
            $kayttaja->ryhma = $tulos->ryhma;
            return $kayttaja;
        }
    }

    public function getRyhma() {
        return $this->ryhma;
    }

    public function getId() {
        return $this->id;
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

}
