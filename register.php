<?php

require_once 'libs/controller.php';
$params = array();

if (requestMethodIsPost()) {
    if (arvotEivatOleTyhjia(array(
                'rek_tunnus' => 'Rekisteröityminen epäonnistui! Et antanut tunnusta.',
                'rek_salasana' => 'Rekisteröityminen epäonnistui! Et antanut Salasana.'))) {
        $tunnus = getPost('rek_tunnus');
        $salasana = getPost('rek_salasana');
        $lupaus = !!getPost('rek_lupaus');
        if ($lupaus) {
            if (stringPituusAlle($tunnus, 32)) {
                if (Kayttaja::uusiKayttaja($tunnus, $salasana)) {
                    kirjaaSisaan(Kayttaja::haeKayttaja($tunnus, $salasana));
                } else {
                    setSessionViesti('Samanniminen tunnus on jo olemassa: ' . $tunnus);
                }
            } else {
                setSessionViesti('Tunnus on liian pitkä tai lyhyt: ' . $tunnusPituus);
            }
        } else {
            setSessionViesti('Sinun pitää antaa lupaus, (' . $lupaus . ')');
        }
        redirect('index');
    }
}
naytaNakyma('register', $params);
