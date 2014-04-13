<?php

require_once 'libs/models/kayttaja.php';
require_once 'libs/models/groups/ryhma.php';
require_once 'libs/models/aihe.php';
require_once 'libs/databaseexception.php';
session_start();

        const session_name = 'kayttaja';
        const session_viesti = 'viesti';
        const onnistumis_viesti = 'onnistuminen';

//Asetaan muuttujia näkymille ja varmistetaan oikeudet sivulle,
//tullaan siirtämään data:an.
function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    $kirj = onKirjautunut() ? 'greet' : 'login';
    $kayttaja = onKirjautunut() ? getKirjautunut() : null;
    $ryhma = getRyhmaID($kayttaja);
    $aiheet = Aihe::getAiheet();
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
    $onnistuminen = null;
    if (onkoOnnistumisViesti()) {
        $onnistuminen = getOnnistumisViesti();
        poistaOnnistumisViesti();
    }
    if (!$ryhma->paaseeSivulle(getSivu())) {
        setSessionViesti('Sinulla ei ole oikeuttaa nähdä sivua ' . getSivu());
        redirect('index');
    }
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

//Onnistumisviestintään
function setOnnistumisViesti($param) {
    $_SESSION[onnistumis_viesti] = $param;
}

function onkoOnnistumisViesti() {
    return isset($_SESSION[onnistumis_viesti]);
}

function poistaOnnistumisViesti() {
    unset($_SESSION[onnistumis_viesti]);
}

function getOnnistumisViesti() {
    return $_SESSION[onnistumis_viesti];
}

//Virheviestintään
function setSessionViesti($param) {
    $_SESSION[session_viesti] = $param;
}

function onkoSessionViestia() {
    return isset($_SESSION[session_viesti]);
}

function getSessionViesti() {
    return $_SESSION[session_viesti];
}

function poistaSessionViesti() {
    unset($_SESSION[session_viesti]);
}

function getQueryString($string) {
    return filter_input(INPUT_GET, $string);
}

//Var 0: Uusisivu
//Var 1: QueryString
function redirect() {
    $query = null;
    if (func_num_args() > 1) {
        $query = func_get_arg(1);
    }
    header('Location: ' . func_get_arg(0) . '.php' . (!empty($query) ? '?' . $query : ''));
    die();
}

//Funktiot alla varmistavat annetut arvot, arrayssa on arvo ja sen virhe viesti.
//Varmaankin poistetaan ennen lopullista palautusta.
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
