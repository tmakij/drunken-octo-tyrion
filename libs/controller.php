<?php

error_reporting(E_ALL);
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/groups/ryhma.php';
require_once 'libs/models/aihe.php';
require_once 'libs/databaseexception.php';
require_once 'libs/models/luetutviestit.php';
session_start();

        const session_name = 'kayttaja';
        const session_viesti = 'viesti';
        const onnistumis_viesti = 'onnistuminen';

//Varmistetaan oikeudet sivulle, ja näytetään oikea sivu ja sen osat.
function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    $ryhma = getRyhmaID(onKirjautunut() ? getKirjautunut() : null);

    if (!$ryhma->paaseeSivulle(getSivu())) {
        setSessionViesti('Sinulla ei ole oikeuttaa nähdä sivua ' . getSivu());
        redirect('index');
    }
    require 'views/base.php';
    die();
}

function saaMuokataViestiä($kayttaja, $viesti) {
    return getRyhmaID($kayttaja)->voiHallita() || $kayttaja->getId() === $viesti->getKirjoittajaID();
}

function onLuettuKetju($viestiKetjuID) {
    if (onKirjautunut()) {
        return kayttjaOnLukenutKetjun($viestiKetjuID, getKirjautunut()->getId());
    }
    return true;
}

function haeAihe($param) {
    return !empty($param) ? Aihe::getAihe($param->getAihe()) : Aihe::getAihe(-1);
}

function getRyhmaID($kayttaja) {
    return getRyhma($kayttaja === null ? -1 : $kayttaja->getRyhma());
}

function getPost($var) {
    return filter_input(INPUT_POST, $var);
}

function requestMethodIsPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getSivu() {
    return basename($_SERVER['PHP_SELF']);
}

function sanitize($param) {
    return htmlspecialchars($param, ENT_QUOTES, 'UTF-8');
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

//Onnistumisviestintään
function setOnnistumisViesti($param) {
    $_SESSION[onnistumis_viesti] = $param;
}

function onOnnistumisViesti() {
    return isset($_SESSION[onnistumis_viesti]);
}

function getOnnistumisViesti() {
    return getSession(onnistumis_viesti);
}

//Virheviestintään
function setSessionViesti($param) {
    $_SESSION[session_viesti] = $param;
}

function onSessionViesti() {
    return isset($_SESSION[session_viesti]);
}

function getSessionViesti() {
    return getSession(session_viesti);
}

//Yhteinen getSession
function getSession($param) {
    $viesti = $_SESSION[$param];
    unset($_SESSION[$param]);
    return $viesti;
}

//

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

function stringPituusAlle($string, $pituus) {
    return strlen($string) < $pituus;
}

// Loput ovat arvojen tarkistukseen, sekä virheviestien asettamiseen:

function tyhja($param) {
    return empty($param);
}

function eiInteger($param) {
    return !ctype_digit($param);
}

        const isInt = 'eiInteger';
        const onTyhja = 'tyhja';

function arvotOvatNumerisiaQuery($params) {
    return tarkistaArvotQuery(isInt, $params);
}

function arvotOvatNumerisia($params) {
    return tarkistaArvotPost(isInt, $params);
}

function arvotEivatOleTyhjiaQuery($params) {
    return tarkistaArvotQuery(onTyhja, $params);
}

function arvotEivatOleTyhjia($params) {
    return tarkistaArvotPost(onTyhja, $params);
}

function tarkistaArvotPost($check, $params) {
    return tarkistaArvotLahde($check, 'getPost', $params);
}

function tarkistaArvotQuery($check, $params) {
    return tarkistaArvotLahde($check, 'getQueryString', $params);
}

function tarkistaArvotLahde($check, $lahde, $params) {
    foreach ($params as $key => $value) {
        $arvo = call_user_func($lahde, $key);
        $res = call_user_func($check, $arvo);
        if ($res) {
            setSessionViesti($value);
            return false;
        }
    }
    return true;
}
