<?php

require_once 'libs/controller.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/viestiketju.php';

$params = array('ketjut' => Viestiketju::getKetjut());

if (requestMethodIsPost()) {
    $id = getQueryString('delete');
    if (empty($id)) {
        if (onKirjautunut()) {
            kirjaaUlos();
        } else {
            kirjaudu();
        }
    } else if (onKirjautunut() && getRyhmaID(getKirjautunut()->getRyhma())->voiHallita()) {
        Viestiketju::poistaKetju($id);
    }
    redirect('index');
}
naytaNakyma('index', $params);

function kirjaudu() {
    if (arvotEivatOleTyhjia(array(
                'tunnus' => 'Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.',
                'salasana' => 'Kirjautuminen epäonnistui! Et antanut salasanaa.'
            ))) {
        try {
            $tunnus = getPost('tunnus');
            $salasana = getPost('salasana');
            $kayttaja = Kayttaja::haeKayttaja($tunnus, $salasana);
            kirjaaSisaan($kayttaja);
            redirect('index');
        } catch (DataBaseException $ex) {
            setSessionViesti('Käyttäjätunnus tai salasana on väärä');
        }
    }
}
