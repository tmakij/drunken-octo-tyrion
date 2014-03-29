<?php

require_once 'libs/models/kayttaja.php';
session_start();

        const session_name = 'kayttaja';

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    $kirj = onKirjautunut() ? 'greet' : 'login';
    require 'views/base.php';
    die();
}

function kirjaaSisaan($kayttaja) {
    $_SESSION[session_name] = $kayttaja;
}

function kirjaaUlos() {
    unset($_SESSION[session_name]);
}

function getKirjautunut() {
    return $_SESSION[session_name];
}

function onKirjautunut() {
    return isset($_SESSION[session_name]);
}

function redirect($page) {
    header('Location: ' . $page . '.php');
    die();
}
