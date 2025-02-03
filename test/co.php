<?php
require_once __DIR__ . '/../index.php';

$version = phpversion();

function testCo(...$params){
    $res = func_get_args();
    // $res = json_encode($params);
    // $res = hash('sha512', $res);

    echo PHP_EOL;
    var_export($res);
    echo PHP_EOL;
}

$obj = new stdClass();
$obj->prop = 'ten';
testCo(1,2,3, [4,5,6], 'sevetn', ['eight','nine'], $obj);