<?php

include 'db_const.php';
if (!(defined("db_host_name") && defined("db_name") && defined("db_user_name") && defined("db_password"))) {
    die("Set database constants properly in db_const.php");
}

$dbconn = pg_connect("host=" . db_host_name . " dbname=" . db_name . " user=" . db_user_name . " password=" . db_password)
        or die('Could not connect: ' . pg_last_error());

print_sql('SELECT * FROM kayttaja where kayttaja.id = 1');
print_sql('SELECT * FROM aihe where aihe.id = 1');
print_sql('SELECT * FROM viestiketju where viestiketju.id = 1');
print_sql('SELECT * FROM viesti where viesti.id = 1');
print_sql('SELECT * FROM viesti_kayttaja where viesti_kayttaja.kayttaja = 1');

pg_free_result($result);
pg_close($dbconn);

function print_sql($query) {
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    while ($array = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        foreach ($array as $line) {
            echo $line . "<br>";
        }
    }
    echo "<br><br><br><br>";
}
