<?php

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    naytaNakyma('index', array());
}

if (onKirjautunut()) {
    kirjauduUlos();
} else {
    kirjaudu();
}

function kirjaudu() {
    $tunnus = $_POST['tunnus'];

    if (empty($tunnus)) {
        naytaNakyma('index', array(
            'virhe' => 'Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.',
        ));
    }

    $salasana = $_POST["salasana"];

    if (empty($salasana)) {
        naytaNakyma('index', array(
            'virhe' => 'Kirjautuminen epäonnistui! Et antanut salasanaa.',
        ));
    }
    $kayttaja = Kayttaja::haeKayttaja($tunnus, $salasana);

    if ($kayttaja != null && $tunnus == $kayttaja->getNimi() && $salasana == $kayttaja->getSalasana()) {
        kirjaaSisaan($kayttaja);
        redirect('index');
    } else {
        naytaNakyma('index', array(
            'virhe' => 'Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.'
        ));
    }
}

function kirjauduUlos() {
    kirjaaUlos();
    naytaNakyma('index', array());
}
