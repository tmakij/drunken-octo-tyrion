<?php

require_once 'libs/controller.php';
require_once 'libs/models/viesti.php';
$params = array();

$kayttajaNimi = getQueryString('nimi');
$aihe = getQueryString('aihe');
$aikaAlku = getQueryString('aika_alku');
$aikaLoppu = getQueryString('aika_loppu');

if (!empty($kayttajaNimi)) {
    if (is_numeric($aihe)) {
        if (onPaivays($aikaAlku) && onPaivays($aikaLoppu)) {
            try {
                $params['viestit'] = Viesti::getTietytViestit($kayttajaNimi, $aihe, $aikaAlku, $aikaLoppu);
                naytaNakyma('searchresults', $params);
            } catch (DataBaseException $ex) {
                setSessionViesti('Hakutulos oli tyhja');
            }
        } else {
            setSessionViesti('Epäkelpo aika: ' . $aikaAlku . ', ' . $aikaLoppu);
        }
    } else {
        setSessionViesti('Tuntematon aihe, id:' . $aihe);
    }
} else {
    setSessionViesti('Anna käyttäjän nimi');
}
redirect('search');

function onPaivays($param) {
    return DateTime::createFromFormat('y-m-d', $param) !== null;
}
