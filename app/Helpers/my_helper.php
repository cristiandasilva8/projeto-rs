<?php

// app/Helpers/my_helper.php

function random_numeric_string($length = 6)
{
    $numbers = '0123456789';
    return substr(str_shuffle(str_repeat($numbers, ceil($length / strlen($numbers)))), 0, $length);
}

if (!function_exists('v2p')) {
    function v2p($string)
    {
        return str_replace(',', '.', str_replace('.', '', $string));
    }
}
if (!function_exists('p2v')) {

    function p2v($string)
    {
        return str_replace('.', ',', str_replace(',', '', $string));
    }
}

if (!function_exists('moeda')) {
    function moeda($numero)
    {
        return number_format($numero, 2, ',', '.');
    }
}
