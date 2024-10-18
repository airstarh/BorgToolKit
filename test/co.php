<?php
require_once __DIR__ . '/../index.php';

$a = [
    'key' =>
        [
            'a' => 'a',
            'b' => 'b',
        ],
];

foreach ($a as $key => $v) {
    $v['d'] = 'd';
}

echo PHP_EOL;
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
var_export($a);
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
echo PHP_EOL;
