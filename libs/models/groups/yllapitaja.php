<?php

require_once 'libs/models/groups/rekisteroitynyt.php';

final class Yllapitaja extends Rekisteroitynyt {

    public function voiHallita() {
        return true;
    }

    protected function nimi() {
        return 'Ylläpitäjä';
    }

    protected function getSallitutSivut() {
        return array_merge(parent::getSallitutSivut(), array('admin.php', 'editthread.php'));
    }

}
