<?php

require_once 'libs/databaseexception.php';

function getTietokantayhteys() {
    static $yhteys = null;
    if ($yhteys == null) {
        $yhteys = new PDO('pgsql:');
        $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $yhteys;
}

function kyselePohja($sql) {
    $kysely = getTietokantayhteys()->prepare($sql);
    return $kysely;
}

function kysele($kysely, $params) {
    $kysely->execute($params);
    return $kysely;
}

function query($sql, $action, $params = array()) {
    $tulos = $action(kysele(kyselePohja($sql), $params));
    if ($tulos == null) {
        throw new DataBaseException();
    }
    return $tulos;
}

function querySingle($sql, $params = array()) {
    return query($sql, function ($kysely) {
        return $kysely->fetchObject();
    }, $params);
}

function queryArray($sql, $params = array()) {
    return query($sql, function ($kysely) {
        return $kysely->fetchAll(PDO::FETCH_OBJ);
    }, $params);
}

function queryMaara($sql, $params = array()) {
    return query($sql, function ($kysely) {
        return $kysely->fetchColumn();
    }, $params);
}

function tallennaTietokantaan($sql, $params = array()) {
    $kysely = kyselePohja($sql);
    kysele($kysely, $params);
    return $kysely;
}

function tallennaAinutlaatuinen($sql, $params, $onnistunutSql, $onnistunutSqlParams) {
    try {
        queryArray($sql, $params);
    } catch (DataBaseException $ex) { //Lopputulos oli tyhjä, eli arvoisia ei ole.
        tallennaTietokantaan($onnistunutSql, $onnistunutSqlParams);
        return true;
    }
    return false;
}
