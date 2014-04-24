<?php

require_once 'libs/controller.php';
require_once 'libs/models/viesti.php';

$params = array();

if (arvotEivatOleTyhjiaQuery(array('nimi' => 'Anna käyttäjän nimi'))) {
    if (arvotOvatNumerisiaQuery(array('aihe' => 'Tuntematon aihe, id:' . $aihe))) {
        $aikaAlku = getQueryString('aika_alku');
        $aikaLoppu = getQueryString('aika_loppu');
        if (onPaivays($aikaAlku) && onPaivays($aikaLoppu)) {
            try {
                $kayttajaNimi = getQueryString('nimi');
                $aihe = getQueryString('aihe');
                $params['viestit'] = Viesti::getTietytViestit($kayttajaNimi, $aihe, $aikaAlku, $aikaLoppu);
                naytaNakyma('searchresults', $params);
            } catch (DataBaseException $ex) {
                setSessionViesti('Hakutulos oli tyhja');
            }
        } else {
            setSessionViesti('Epäkelpo aika: ' . $aikaAlku . ', ' . $aikaLoppu);
        }
    }
}
redirect('search');

function onPaivays($param) {
    return DateTime::createFromFormat('y-m-d', $param) !== null;
}
