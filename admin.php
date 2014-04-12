<?php

require_once 'libs/controller.php';
require_once 'libs/models/aihe.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/groups/ryhma.php';

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
            asetaKayttajaRyhma();
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
    $id = getPost('aihe');
    if (is_numeric($id)) {
        if (Aihe::poistaAihe($id)) {
            setOnnistumisViesti('Aihe on poistettu');
        } else {
            setSessionViesti('Aihetta ei voida poistaa jos se on yhdenkään viestiketjun aihe');
        }
    } else {
        setSessionViesti('Aihetta ei voida poistaa, id: ' . $id);
    }
}

function asetaKayttajaRyhma() {
    $kayttajaNimi = getPost('kayttaja_nimi');
    $ryhma = getPost('ryhma');
    if (is_numeric($ryhma)) {
        if (!empty($kayttajaNimi)) {
            if (Kayttaja::asetaRyhma($kayttajaNimi, $ryhma)) {
                setOnnistumisViesti('Käyttäjä ' . $kayttajaNimi . ' on asetettu ryhmaan ' . getRyhma($ryhma));
            } else {
                setSessionViesti('Käyttäjää nimeltä ' . $kayttajaNimi . ' ei ole olemassa');
            }
        } else {
            setSessionViesti('Et antanut käyttäjän nimeä');
        }
    } else {
        setSessionViesti('Ryhmää ei ole olemassa: ' . $ryhma);
    }
}
