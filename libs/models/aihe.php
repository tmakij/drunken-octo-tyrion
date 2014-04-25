<?php

final class Aihe extends IDobject {

    private $nimi;

    function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
    }

    public function poistaAihe($id) {
        try {
            tallennaTietokantaan('DELETE FROM aihe WHERE id = ?', array($id));
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public static function uusiAihe($nimi) {
        return tallennaAinutlaatuinen('SELECT nimi FROM aihe WHERE nimi = ?', array($nimi), 'INSERT INTO aihe(nimi) VALUES(?)', array($nimi));
    }

    public static function getAihe($id) {
        $tulos = $id !== -1 ? querySingle('SELECT nimi, id FROM aihe where id = ?', array($id)) :
                querySingle('SELECT nimi, id FROM aihe LIMIT 1', array());
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
