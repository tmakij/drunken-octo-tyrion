<?php

require_once 'libs/controller.php';

if (requestMethodIsPost()) {
    redirect('searchresults', 'nimi=' . getPost('haku_kayttaja_nimi')
            . '&aihe=' . getPost('aihe')
            . '&aika_alku=' . getPost('aika_alku')
            . '&aika_loppu=' . getPost('aika_loppu'));
}

naytaNakyma('search', array());
