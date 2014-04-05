<?php

require_once 'libs/tietokantayhteys.php';

abstract class IDobject {

    protected $id;

    public function getId() {
        return $this->id;
    }

}
