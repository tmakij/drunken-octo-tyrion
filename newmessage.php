<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';
$params = array();

if (getRequestMethod() === 'POST') {
    varmistaArvotTyhjat((function () {
        $otsikko = getPost('otsikko');
        $sisalto = getPost('sisalto');
        $aihe = getPost('aihe');
        $otsikkoPituus = strlen($otsikko);
        if ($otsikkoPituus > 0 && $otsikkoPituus < 32) {
            if (is_numeric($aihe)) {
                Viestiketju::luoKetju($otsikko, $aihe, $sisalto, getKirjautunut()->getId());
            } else {
                setSessionViesti('Tuntematon aihe: ' . $aihe);
            }
        } else {
            setSessionViesti('Otsikko on liian pitkä tai lyhyt: ' . $otsikkoPituus);
        }
        redirect('index');
    }), array(
        'otsikko' => 'Viestin lähetys epäonnistui! Et antanut otsikkoa.',
        'sisalto' => 'Viestin lähetys epäonnistui! Viestisi oli tyhjä.'
            ), $params);
}
$params['aiheet'] = Aihe::getAiheet();
naytaNakyma('newmessage', $params);
