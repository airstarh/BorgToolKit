<?php
require_once __DIR__ . '/../index.php';

$float = 123.456789;
$float = 109035655.60000000;
$res['$float'] = $float;

$number_format = number_format($float, 4, '.', '');
$res['$number_format'] = $number_format;

$sprintf = sprintf('%.4f', $float);
$res['$sprintf'] = $sprintf;

echo PHP_EOL;
var_export($res);
echo PHP_EOL;