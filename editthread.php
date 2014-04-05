<?php

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/viestiketju.php';

$params = array();

$ketjuId = getQueryString('id');
if (isset($ketjuId) && is_numeric($ketjuId)) {
    if (getRequestMethod() === 'POST') {
        
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
