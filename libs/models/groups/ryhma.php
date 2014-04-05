<?php

require_once 'libs/models/groups/vierailija.php';
require_once 'libs/models/groups/rekisteroitynyt.php';
require_once 'libs/models/groups/yllapitaja.php';
require_once 'libs/models/groups/viestikielto.php';
require_once 'libs/models/groups/ryhma.php';

interface Ryhma {

    function voiViestia();

    function voiHallita();

    function paaseeSivulle($sivu);
}

;
        const Vierailija = -1;
        const Viestikielto = 0;
        const Yllapitaja = 1;
        const Rekisteroitynyt = 2;

function getRyhma($ryhma) {
    switch ($ryhma) {
        case Viestikielto:
            return new Viestikielto();
        case Yllapitaja:
            return new Yllapitaja();
        case Rekisteroitynyt:
            return new Rekisteroitynyt();
        default:
            return new Vierailija();
    }
}
