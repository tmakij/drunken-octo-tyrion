<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';
require_once 'libs/models/viesti.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/luetutviestit.php';
$params = array();
$threadId = getQueryString('id');
if (arvotOvatNumerisiaQuery(array('id' => 'Tuntematon ketju: ' . $threadId))) {
    try {
        $params['ketju'] = Viestiketju::getKetju($threadId);
        if (requestMethodIsPost() && arvotEivatOleTyhjia(array('sisalto' => 'Viesti ei voi olla tyhja'))) {
            Viesti::uusiViesti($threadId, getPost('sisalto'), getKirjautunut()->getId());
            muutaKetjuLukemattomaksi($threadId);
            redirect('thread', 'id=' . $threadId);
        }
    } catch (DataBaseException $ex) {
        setSessionViesti('Ei löydetty ketjua: ' . $threadId);
        redirect('index');
    }
}
naytaNakyma('response', $params);
