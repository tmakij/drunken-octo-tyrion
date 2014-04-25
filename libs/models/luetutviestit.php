<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/databaseexception.php';

function kayttjaOnLukenutKetjun($viestiKetjuID, $kayttjaID) {
    try {
        querySingle('SELECT kayttaja FROM viesti_kayttaja WHERE kayttaja = ? AND viestiketju = ?', array($kayttjaID, $viestiKetjuID));
        return true;
    } catch (DataBaseException $ex) {
        return false;
    }
}

function lueKetju($viestiKetjuID, $kayttjaID) {
    tallennaTietokantaan('INSERT INTO viesti_kayttaja (kayttaja, viestiketju) VALUES (?, ?)', array($kayttjaID, $viestiKetjuID));
}

function muutaKetjuLukemattomaksi($viestiKetjuID) {
    tallennaTietokantaan('DELETE FROM viesti_kayttaja WHERE viestiketju = ?', array($viestiKetjuID));
}
