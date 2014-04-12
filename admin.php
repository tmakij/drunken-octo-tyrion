<?php

require_once 'libs/controller.php';

$params = array();

if (getRequestMethod() === 'POST') {
    switch (getPost('toiminto')) {
        case 'lisaa_aihe':
            lisaaAihe();
            break;
        case 'poista_aihe':
            poistaAihe();
            break;
        case 'aseta_kayttaja_ryhma':
            break;
        default:
            setSessionViesti('Tuntematon toiminto: ' . getPost('toiminto'));
            break;
    }
}
naytaNakyma('admin', $params);

function lisaaAihe() {
    $aihe = getPost('uusi_aihe');
    if (!empty($aihe)) {
        $pituus = strlen($aihe);
        if ($pituus < 31) {
            if (Aihe::uusiAihe($aihe)) {
                setOnnistumisViesti('Luotiin uusi aihe: ' . $aihe);
            } else {
                setSessionViesti('On olemassa saman niminen aihe: ' . $aihe);
            }
        } else {
            setSessionViesti('Aiheen nimi liian pitkä: ' . $pituus);
        }
    } else {
        setSessionViesti('Anna aiheen nimi');
    }
}

function poistaAihe() {
    
}

function asetaKayttajaRyhma() {
    
}
