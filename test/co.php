<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

####################################################################################################

$a = [
    1,
    1,
    true,
    'a',
    null,
];

// $res = array_sum($a);
$res = is_numeric(' 12');

####################################################################################################
echo PHP_EOL;
echo PHP_EOL;
var_export($res, 0);
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;