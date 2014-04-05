<?php

require_once 'libs/common.php';
$params = array();

if (getRequestMethod() !== 'GET') {
    varmistaArvotTyhjat((function () {
        $otsikko = getPost('otsikko');
        $sisalto = getPost('sisalto');
    }), array(
        'otsikko' => 'Viestin lähetys epäonnistui! Et antanut otsikkoa.',
        'sisalto' => 'Viestin lähetys epäonnistui! Viestisi oli tyhjä.'
            ), $params);
}
naytaNakyma('newmessage', $params);
