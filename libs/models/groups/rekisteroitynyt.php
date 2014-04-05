<?php

require_once 'libs/models/groups/kayttajaryhma.php';

class Rekisteroitynyt extends Kayttajaryhma {

    public function voiViestia() {
        return true;
    }

    protected function nimi() {
        return 'Käyttäjä';
    }

    protected function getSallitutSivut() {
        return array_merge(parent::getSallitutSivut(), array('response.php', 'newmessage.php'));
    }

}
