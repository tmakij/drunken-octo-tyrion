<?php

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    naytaNakyma('index', array());
}
$tunnus = $_POST['tunnus'];

if (empty($tunnus)) {
    naytaNakyma("index", array(
        'virhe' => 'Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.',
    ));
}

$salasana = $_POST["salasana"];

if (empty($salasana)) {
    naytaNakyma('index', array(
        'kayttaja' => $kayttaja,
        'virhe' => 'Kirjautuminen epäonnistui! Et antanut salasanaa.',
    ));
}
$kayttaja = Kayttaja::haeKayttaja($tunnus, $salasana);

if ($kayttaja != null && $tunnus == $kayttaja->getNimi() && $salasana == $kayttaja->getSalasana()) {
    redirect('admin');
} else {
    naytaNakyma("index", array(
        'kayttaja' => $kayttaja,
        'virhe' => 'Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.'
    ));
}
