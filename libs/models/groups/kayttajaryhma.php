<?php

abstract class Kayttajaryhma implements Ryhma {

    public function voiHallita() {
        return false;
    }

    public function voiViestia() {
        return false;
    }

    public final function __toString() {
        return $this->nimi();
    }

    public function paaseeSivulle($sivu) {
        return in_array($sivu, $this->getSallitutSivut());
    }

    protected function getSallitutSivut() {
        return array('index.php', 'search.php', 'thread.php');
    }

    protected abstract function nimi();
}
