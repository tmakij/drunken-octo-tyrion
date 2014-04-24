<?php

require_once 'libs/controller.php';
require_once 'libs/models/aihe.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/groups/ryhma.php';

$params = array();

if (requestMethodIsPost()) {
    switch (getPost('toiminto')) {
        case 'lisaa_aihe':
            lisaaAihe();
            break;
        case 'poista_aihe':
            poistaAihe();
            break;
        case 'aseta_kayttaja_ryhma':
            asetaKayttajaRyhma();
            break;
        default:
            setSessionViesti('Tuntematon toiminto: ' . getPost('toiminto'));
            break;
    }
}
naytaNakyma('admin', $params);

function lisaaAihe() {
    if (arvotEivatOleTyhjia(array('uusi_aihe' => 'Anna aiheen nimi'))) {
        $aihe = getPost('uusi_aihe');
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
    }
}

function poistaAihe() {
    $id = getPost('aihe');
    if (arvotOvatNumerisia(array('aihe' => 'Aihetta ei voida poistaa, id: ' . $id))) {
        if (Aihe::poistaAihe($id)) {
            setOnnistumisViesti('Aihe on poistettu');
        } else {
            setSessionViesti('Aihetta ei voida poistaa jos se on yhdenkään viestiketjun aihe');
        }
    }
}

function asetaKayttajaRyhma() {
    $kayttajaNimi = getPost('kayttaja_nimi');
    $ryhma = getPost('ryhma');
    if (arvotOvatNumerisia(array('ryhma' => 'Ryhmää ei ole olemassa: ' . $ryhma))) {
        if (arvotEivatOleTyhjia(array('kayttaja_nimi' => 'Et antanut käyttäjän nimeä'))) {
            if (Kayttaja::asetaRyhma($kayttajaNimi, $ryhma)) {
                setOnnistumisViesti('Käyttäjä ' . $kayttajaNimi . ' on asetettu ryhmaan ' . getRyhma($ryhma));
            } else {
                setSessionViesti('Käyttäjää nimeltä ' . $kayttajaNimi . ' ei ole olemassa');
            }
        }
    }
}
