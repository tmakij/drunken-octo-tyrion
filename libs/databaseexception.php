<?php

final class DataBaseException extends Exception {

    public function __construct() {
        parent::__construct('Tulos oli tyhjä', 0, NULL);
    }

}
