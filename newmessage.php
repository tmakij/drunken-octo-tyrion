<?php

require_once 'libs/common.php';
require_once 'libs/models/viestiketju.php';
$params = array();

if (getRequestMethod() === 'POST') {
    varmistaArvotTyhjat((function () {
        $otsikko = getPost('otsikko');
        $sisalto = getPost('sisalto');
        Viestiketju::luoKetju('Wheee', 1, '\o/', 1); //getKirjautunut()->getId()
    }), array(
        'otsikko' => 'Viestin lähetys epäonnistui! Et antanut otsikkoa.',
        'sisalto' => 'Viestin lähetys epäonnistui! Viestisi oli tyhjä.'
            ), $params);
}
naytaNakyma('newmessage', $params);
