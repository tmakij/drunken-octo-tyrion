<?php

interface Ryhma {

    function voiViestia();

    function voiHallita();

    function paaseeSivulle($sivu);
}

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

    const Vierailija = -1;
    const Viestikielto = 0;
    const Yllapitaja = 1;
    const Rekisteroitynyt = 2;

    public static function getRyhma($ryhma) {
        switch ($ryhma) {
            case self::Viestikielto:
                return new Viestikielto();
            case self::Yllapitaja:
                return new Yllapitaja();
            case self::Rekisteroitynyt:
                return new Rekisteroitynyt();
            default:
                return new Vierailija();
        }
    }

}

final class Vierailija extends Kayttajaryhma {

    protected function getSallitutSivut() {
        return array_merge(parent::getSallitutSivut(), array('register.php'));
    }

    protected function nimi() {
        return 'Vierailija';
    }

}

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

final class Yllapitaja extends Rekisteroitynyt {

    public function voiHallita() {
        return true;
    }

    protected function nimi() {
        return 'Ylläpitäjä';
    }

    protected function getSallitutSivut() {
        return array_merge(parent::getSallitutSivut(), array('admin.php'));
    }

}

final class Viestikielto extends Kayttajaryhma {

    protected function nimi() {
        return 'Viestikiellossa';
    }

}
