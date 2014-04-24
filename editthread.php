<?php

require_once 'libs/controller.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/viestiketju.php';

$params = array();

$ketjuId = getQueryString('id');
if (arvotOvatNumerisiaQuery(array('id' => 'Tuntematon ketju: ' . $ketjuId))) {
    if (requestMethodIsPost()) {
        $aihe = getPost('aihe');
        if (arvotOvatNumerisia(array('aihe' => 'Tuntematon aihe: ' . $aihe))) {
            if (arvotEivatOleTyhjia(array('otsikko' => 'Anna otsikko'))) {
                $otsikko = getPost('otsikko');
                if (stringPituusAlle($otsikko, 32)) {
                    Viestiketju::paivitaKetju($ketjuId, $otsikko, $aihe);
                    redirect('index');
                } else {
                    setSessionViesti('Liian pitkä otsikko');
                }
            }
        }
        redirect('editthread', 'id=' . $ketjuId);
    } else {
        try {
            $params['ketju'] = Viestiketju::getKetju($ketjuId);
        } catch (DataBaseException $ex) {
            setSessionViesti('Ei ole olemassa ketjua' . $ketjuId);
            redirect('index');
        }
    }
}

naytaNakyma('editthread', $params);
