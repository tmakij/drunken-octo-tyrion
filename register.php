<?php

require_once 'libs/controller.php';
$params = array();

if (getRequestMethod() === 'POST') {
    varmistaArvotTyhjat((function () {
        $tunnus = getPost('rek_tunnus');
        $salasana = getPost('rek_salasana');
        $lupaus = getPost('rek_lupaus');
        if ($lupaus) {
            $tunnusPituus = strlen($tunnus);
            if ($tunnusPituus < 32) {
                if (Kayttaja::uusiKayttaja($tunnus, $salasana)) {
                    kirjaaSisaan(Kayttaja::haeKayttaja($tunnus, $salasana));
                } else {
                    setSessionViesti('Samanniminen tunnus on jo olemassa: ' . $tunnus);
                }
            } else {
                setSessionViesti('Tunnus on liian pitkä tai lyhyt: ' . $tunnusPituus);
            }
        } else {
            setSessionViesti('Sinun pitää antaa lupaus');
        }
        redirect('index');
    }), array(
        'rek_tunnus' => 'Rekisteröityminen epäonnistui! Et antanut tunnusta.',
        'rek_salasana' => 'Rekisteröityminen epäonnistui! Et antanut Salasana.'
            ), $params);
}
naytaNakyma('register', $params);
