<?php

require_once 'kayttajaryhma.php';

final class Vierailija extends Kayttajaryhma {

    protected function getSallitutSivut() {
        return array_merge(parent::getSallitutSivut(), array('register.php'));
    }

    protected function nimi() {
        return 'Vierailija';
    }

}
