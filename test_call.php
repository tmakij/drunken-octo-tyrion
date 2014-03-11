<?php

$hello_high = 'HELLO WORLD';
$hello_low = strtolower($hello_high);

function get_hello_upper() {
    global $hello_high;
    return $hello_high;
}

function get_hello_lower() {
    global $hello_low;
    return $hello_low;
}
