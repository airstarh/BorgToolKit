<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

####################################################################################################

$format = 'Y-m-d H:i:s';

$value = '2025-12-13 23:59:58';
// $value = '2025-12-13';
$value = time();

// $res = DateTime::createFromFormat($format, $value);

$res = date('Y-m-d H:i:s', $value);

####################################################################################################
echo PHP_EOL;
echo PHP_EOL;
var_export($res, 0);
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
