<?php

require_once 'libs/models/kayttaja.php';
session_start();

        const session_name = 'kayttaja';

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    $kirj = onKirjautunut() ? 'greet' : 'login';
    $kayttaja = onKirjautunut() ? getKirjautunut() : null;
    $ryhma = Kayttajaryhma::getRyhma($kayttaja == null ? -1 : $kayttaja->getRyhma());
    if (!$ryhma->paaseeSivulle(getSivu())) {
        die('Sinulla ei ole oikeuttaa nähdä sivua ' . getSivu());
    }

    //Ei taida tehä mitään...
    $link_index = '<li><a href="index.php"' . (getSivu() == 'index.php' ? ' class="active"' : '') . '>Etusivu</a></li>';
    $link_search = '<li><a href="search.php"' . (getSivu() == 'search.php' ? ' class="active"' : '') . '>Haku</a></li>';
    $link_register = $ryhma->paaseeSivulle('register.php') ?
            '<li><a href="register.php"' . (getSivu() == 'register.php' ? ' class="active"' : '') . '>Rekisteröidy</a></li>' : '';
    $link_admin = $ryhma->paaseeSivulle('admin.php') ?
            '<li><a href="admin.php"' . (getSivu() == 'admin.php' ? ' class="active"' : '') . '>Hallinta</a></li>' : '';
    require 'views/base.php';
    die();
}

function getSivu() {
    return basename($_SERVER['PHP_SELF']);
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
