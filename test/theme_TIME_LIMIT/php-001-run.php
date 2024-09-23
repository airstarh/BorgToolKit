<?php
require_once __DIR__ . '/../../index.php';
require_once './php-001.php';

$TimeTest = new TimeTest();



$res = $TimeTest->main();

echo PHP_EOL;
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
var_export($res);
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
echo PHP_EOL;