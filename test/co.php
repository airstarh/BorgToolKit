<?php
require_once __DIR__ . '/../index.php';

$a = [
    'aaa' => [
        'bbb' => 100,
    ],
];

$res = DataHelper::setByPath('', '=',['asd' => 123,], $b);

BorgDebug::dumpBeautiful($b);
BorgDebug::dumpBeautiful($res);
BorgDebug::dumpBeautiful(explode('/', ''));