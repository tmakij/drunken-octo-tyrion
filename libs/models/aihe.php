<?php

final class Aihe extends IDobject {

    private $nimi;

    function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
    }

    public function poistaAihe($id) {
        tallennaTietokantaan('DELETE FROM aihe WHERE nimi = ?', array($id));
        return true;
    }

    public static function uusiAihe($nimi) {
        return tallennaAinutlaatuinen('SELECT nimi FROM aihe WHERE nimi = ?', array($nimi), 'INSERT INTO aihe(nimi) VALUES(?)', array($nimi));
    }

    public static function getAihe($id) {
        $tulos = querySingle('SELECT nimi, id FROM aihe where id = ?', array($id));
        $aihe = new Aihe($tulos->id, $tulos->nimi);
        return $aihe;
    }

    public static function getAiheet() {
        $tulos = queryArray('SELECT nimi, id FROM aihe ORDER BY nimi', array());
        $aiheet = array();
        foreach ($tulos as $aiheTulos) {
            $aihe = new Aihe($aiheTulos->id, $aiheTulos->nimi);
            array_push($aiheet, $aihe);
        }
        return $aiheet;
    }

    public function __toString() {
        return $this->nimi;
    }

}
