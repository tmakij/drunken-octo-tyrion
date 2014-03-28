<?php

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/base.php';
    exit();
}

function redirect($page) {
    header('Location: ' . $page . '.php');
    die();
}
