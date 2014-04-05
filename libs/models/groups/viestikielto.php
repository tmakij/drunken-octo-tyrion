<?php

require_once 'libs/models/groups/kayttajaryhma.php';

final class Viestikielto extends Kayttajaryhma {

    protected function nimi() {
        return 'Viestikiellossa';
    }

}
