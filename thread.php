<?php

require_once 'libs/common.php';

$params = array();
lataaKetju();

naytaNakyma('thread', array());

function lataaKetju() {
    global $params;
    try {
        $ketjuID = getQueryString('thread');
        varmistaArvot(function () {
            $ketjuID = getQueryString('thread');
            $ketju = Viestiketju::getKetju($ketjuID);
            $params['ketju'] = $ketju;
        }, is_numeric($var), array($ketjuID => 'Virhe, ketjua' . $ketjuID . ' ei ole olemassa'), $params);
    } catch (Exception $ex) {
        $params['virhe'] = 'Virhe, ketjua' . $ketjuID . ' ei ole olemassa';
    }
}
