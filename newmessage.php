<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';
$params = array();

if (getRequestMethod() === 'POST') {
    varmistaArvotTyhjat((function () {
        $otsikko = getPost('otsikko');
        $sisalto = getPost('sisalto');
        $aihe = getPost('aihe');
        if (is_numeric($aihe)) {
            Viestiketju::luoKetju($otsikko, $aihe, $sisalto, getKirjautunut()->getId());
            redirect('index');
        } else {
            setSessionViesti('Tuntematon aihe: ' . $aihe);
        }
    }), array(
        'otsikko' => 'Viestin lähetys epäonnistui! Et antanut otsikkoa.',
        'sisalto' => 'Viestin lähetys epäonnistui! Viestisi oli tyhjä.'
            ), $params);
}
$params['aiheet'] = Aihe::getAiheet();
naytaNakyma('newmessage', $params);
