<?php

require_once 'libs/controller.php';
require_once 'libs/models/viestiketju.php';
require_once 'libs/databaseexception.php';

$params = array();

$ketjuID = getQueryString('id');
if (arvotOvatNumerisiaQuery(array('id' => 'Virheellinen id: ' . $ketjuID))) {
    try {
        $ketju = Viestiketju::getKetju($ketjuID);
        $params['ketju'] = $ketju;
        $params['viestit'] = $ketju->getViestit();
        if (onKirjautunut()) {
            $kayttjaID = getKirjautunut()->getId();
            if (!kayttjaOnLukenutKetjun($ketjuID, $kayttjaID)) {
                lueKetju($ketjuID, $kayttjaID);
            }
        }
        naytaNakyma('thread', $params);
    } catch (DataBaseException $ex) {
        setSessionViesti('Ei löytynyt ketjua jolla on id: ' . $ketjuID);
    }
}
redirect('index');
