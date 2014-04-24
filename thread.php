<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';

$params = array();

$ketjuID = getQueryString('id');
if (arvotOvatNumerisiaQuery(array('id' => 'Virhe ketjua, jolla on id ' . $ketjuID . ', ei ole olemassa'))) {
    $ketju = Viestiketju::getKetju($ketjuID);
    $params['ketju'] = $ketju;
    naytaNakyma('thread', $params);
}
redirect('index');
