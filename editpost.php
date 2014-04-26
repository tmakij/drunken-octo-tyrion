<?php

require_once 'libs/controller.php';
require_once 'libs/models/viesti.php';
require_once 'libs/databaseexception.php';

$params = array();
$viestiId = getQueryString('id');
if (arvotOvatNumerisiaQuery(array('id' => 'Virheellinen id: ' . $viestiId))) {
    if (onKirjautunut()) {
        $viesti;
        try {
            $viesti = Viesti::haeViesti($viestiId);
            if (saaMuokataViestiä(getKirjautunut(), $viesti)) {
                if (requestMethodIsPost() && arvotEivatOleTyhjia(array('sisalto' => 'Viesti ei voi olla tyhja'))) {
                    Viesti::muutaViestia($viesti->getId(), getPost('sisalto'));
                    redirect('index');
                }
                $params['viesti'] = $viesti;
                naytaNakyma('editpost', $params);
            }
        } catch (DataBaseException $ex) {
            setSessionViesti('Ei ole olemassa kirjoitusta, jolla on id: ' . $viestiId);
            naytaNakyma('index', $params);
        }
    }
    setSessionViesti('Sinulla ei ole oikeutta muokata viestiä');
}

redirect('index');
