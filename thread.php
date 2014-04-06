<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';

$params = array();
lataaKetju();

//redirect('index');

function lataaKetju() {
    global $params;
    $ketjuID = getQueryString('id');
    if (is_numeric($ketjuID)) {
        $ketju = Viestiketju::getKetju($ketjuID);
        $params['ketju'] = $ketju;
        naytaNakyma('thread', $params);
    }
    setSessionViesti('Virhe ketjua, jolla on id ' . $ketjuID . ', ei ole olemassa');
}
