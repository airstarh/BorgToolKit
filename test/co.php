<?php

$a = 1234;
$b = 1.2;
$c = null;
$d = 0;
$e = '';
$UND = 'UNDEFINED';

$res = sprintf(
    '%s %s %s %s %s %s',
    $a ?? $UND,
    $b ?? $UND,
    $c ?? $UND,
    $d ?? $UND,
    $e ?? $UND,
    $undefined ?? $UND,

);


echo PHP_EOL;
echo $res;
echo PHP_EOL;