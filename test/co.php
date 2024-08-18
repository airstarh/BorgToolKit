<?php
require_once __DIR__ . '/../index.php';
$s = [
    'null, 1234, 1.258"',
];
$d = array_map('castArray', $s);

echo PHP_EOL;
var_export($s);
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
var_export($d);
echo PHP_EOL;

