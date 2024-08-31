<?php
require_once __DIR__ . '/../index.php';
$s = [
    0,
    '0',
    1,
    '1',
    true,
    false,
    null,
    'true',
    'false',
    'null',
    '{}',
    '[]',
    'some',
    -1,
    '-1',

];
$d = [];
foreach($s as $k=>$v){
    $title = var_export($v, true);
    $d["FOR $title"] = filter_var($v, FILTER_VALIDATE_BOOLEAN, false);
}

echo PHP_EOL;
var_export($s);
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
var_export($d);
echo PHP_EOL;

