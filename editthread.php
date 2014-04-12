<?php

require_once 'libs/controller.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/viestiketju.php';

$params = array();

$ketjuId = getQueryString('id');
if (isset($ketjuId) && is_numeric($ketjuId)) {
    if (getRequestMethod() === 'POST') {
        $aihe = getPost('aihe');
        $otsikko = getPost('otsikko');
        if (isset($aihe) && is_numeric($aihe) && !empty($otsikko)) {
            Viestiketju::paivitaKetju($ketjuId, $otsikko, $aihe);
            redirect('index');
        }
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
