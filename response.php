<?php

require_once 'libs/common.php';
require_once 'libs/models/viestiketju.php';
require_once 'libs/models/viesti.php';
require_once 'libs/models/kayttaja.php';
$params = array();
$threadId = getQueryString('id');
if (is_numeric($threadId)) {
    try {
        $params['ketju'] = Viestiketju::getKetju($threadId);
        if (getRequestMethod() === 'POST') {
            Viesti::uusiViesti($threadId, getPost('sisalto'), getKirjautunut()->getId());
            redirect('index');
        }
    } catch (DataBaseException $ex) {
        setSessionViesti('Ei löydetty ketjua: ' . $threadId);
        redirect('index');
    }
}
naytaNakyma('response', $params);
