<?php
require_once __DIR__ . '/../index.php';

$version = phpversion();

$i = 0;
echo $i++;
echo $i++;
echo $i++;
echo $i++;
echo $i++;
echo $i++;
echo $i++;
echo $i++;
echo $i++;
echo $i++;

var_export($argv);

BorgDebug::dumpBeautiful($version);