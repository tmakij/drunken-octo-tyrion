<?php

require_once 'libs/models/kayttaja.php';
require_once 'libs/models/groups/ryhma.php';
require_once 'libs/models/aihe.php';
require_once 'libs/databaseexception.php';
session_start();

        const session_name = 'kayttaja';
        const session_viesti = 'viesti';

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    $kirj = onKirjautunut() ? 'greet' : 'login';
    $kayttaja = onKirjautunut() ? getKirjautunut() : null;
    $ryhma = getRyhmaID($kayttaja);
    $aiheet = isset($data->aiheet) ? $data->aiheet : null;
    $ketju = isset($data->ketju) ? $data->ketju : null;
    $aihe = isset($ketju) ? Aihe::getAihe($ketju->getAihe()) : Aihe::getAihe(1);

    $varoitus = isset($data->virhe) ? $data->virhe : '';
    if (onkoSessionViestia()) {
        if (!empty($varoitus)) {
            $varoitus .= '<br>';
        }
        $varoitus .= getSessionViesti();
        poistaSessionViesti();
    }
    if (!$ryhma->paaseeSivulle(getSivu())) {
        setSessionViesti('Sinulla ei ole oikeuttaa nähdä sivua ' . getSivu());
        redirect('index');
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

function getRyhmaID($kayttaja) {
    return getRyhma($kayttaja == null ? -1 : $kayttaja->getRyhma());
}

function getPost($var) {
    return filter_input(INPUT_POST, $var);
}

function getRequestMethod() {
    return $_SERVER['REQUEST_METHOD'];
}

function getSivu() {
    return basename($_SERVER['PHP_SELF']);
}

function sanitize($param) {
    return htmlspecialchars($param, ENT_QUOTES, 'UTF-8');
}

/* function getRequestMethod() {
  return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
  }

  function getSivu() {
  return basename(filter_input(INPUT_SERVER, 'PHP_SELF'));
  } */

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

function setSessionViesti($param) {
    $_SESSION[session_viesti] = $param;
}

function onkoSessionViestia() {
    return isset($_SESSION[session_viesti]);
}

function getSessionViesti() {
    return $_SESSION[session_viesti];
}

function getQueryString($string) {
    return filter_input(INPUT_GET, $string);
}

function poistaSessionViesti() {
    unset($_SESSION[session_viesti]);
}

function redirect($page, $queryStrings) {
    header('Location: ' . $page . '.php' . (isset($queryStrings) ? '?' . $queryStrings : ''));
    die();
}

function varmistaArvotTyhjat($josOikein, $actions = array(), &$params = array()) {
    varmistaArvot($josOikein, function ($katottava) {
        return empty($katottava);
    }, $actions, $params);
}

function varmistaArvot($josOikein, $check, $actions = array(), &$params = array()) {
    foreach ($actions as $key => $value) {
        $arvo = getPost($key);
        if ($check($arvo)) {
            setSessionViesti($value);
            return;
        }
    }
    if (isset($josOikein)) {
        $josOikein($params);
    }
}
