<?php

require_once 'libs/controller.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/viestiketju.php';

$params = array('ketjut' => Viestiketju::getKetjut());

if (getRequestMethod() === 'POST') {
    $id = getQueryString('delete');
    if (!isset($id) || empty($id)) {
        if (onKirjautunut()) {
            kirjaaUlos();
        } else {
            kirjaudu();
        }
    } else {
        Viestiketju::poistaKetju($id);
        redirect('index');
    }
}
naytaNakyma('index', $params);

function kirjaudu() {
    global $params;

    varmistaArvotTyhjat(function(&$parameters = array()) {
        try {
            $tunnus = getPost('tunnus');
            $salasana = getPost('salasana');
            $kayttaja = Kayttaja::haeKayttaja($tunnus, $salasana);
            if ($tunnus == $kayttaja->getNimi() && $salasana == $kayttaja->getSalasana()) {
                kirjaaSisaan($kayttaja);
                redirect('index');
            }
        } catch (DataBaseException $ex) {
            $parameters['virhe'] = 'Käyttäjtunnus tai salasana on väärä';
        }
    }, array(
        'tunnus' => 'Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.',
        'salasana' => 'Kirjautuminen epäonnistui! Et antanut salasanaa.'
            ), $params);
}
