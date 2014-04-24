<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';
$params = array();

if (requestMethodIsPost()) {
    if (arvotEivatOleTyhjia(array(
                'otsikko' => 'Viestin lähetys epäonnistui! Et antanut otsikkoa.',
                'sisalto' => 'Viestin lähetys epäonnistui! Viestisi oli tyhjä.'
            ))) {
        $otsikko = getPost('otsikko');
        $sisalto = getPost('sisalto');
        $aihe = getPost('aihe');
        if (stringPituusAlle($otsikko, 32)) {
            if (arvotOvatNumerisia(array('aihe' => 'Tuntematon aihe: ' . $aihe))) {
                Viestiketju::luoKetju($otsikko, $aihe, $sisalto, getKirjautunut()->getId());
            }
        } else {
            setSessionViesti('Otsikko on liian pitkä tai lyhyt: ' . $otsikkoPituus);
        }
        redirect('index');
    }
}
naytaNakyma('newmessage', $params);
