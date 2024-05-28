<?php

// app/Helpers/my_helper.php

function random_numeric_string($length = 6)
{
    $numbers = '0123456789';
    return substr(str_shuffle(str_repeat($numbers, ceil($length / strlen($numbers)))), 0, $length);
}
