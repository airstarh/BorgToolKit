<?php
require_once __DIR__ . '/../index.php';
#$a = [];
#$a = new stdClass();
#$a = null;
$a = '';
##$a = '0';
#$a = '1';
#$a = 123;
#$a = '{"a":"1234"}';

$res = [
    '$a'                           => $a,
    '(int)$a'                      => (int)$a,
    '(int)$a ?? null'              => (int)$a ?? null,
    '--------------------------------------------------',
    '(int)($a["asdf"] ?? null)'    => (int)($a["asdf"] ?? null),
    '--------------------------------------------------',
    '(string)$a'                   => (string)$a,
    '_is_json($a)'                 => _is_json((string)$a),
    '--------------------------------------------------',
    'XXX'                          => '0.5' && 1 == 1,
    '--------------------------------------------------',
    '(int)($a["asd"]["qwe"] ?? 0)' => (int)($a["asd"]["qwe"] ?? 0),
    '(int)($a->asad->qwe ?? 0)'    => (int)($a->asad->qwe ?? 0),

];

function _is_json($value): bool
{
    try {
        return is_array(
            json_decode($value, true, 512, JSON_THROW_ON_ERROR)
        );
    } catch (\JsonException $ex) {
        return false;
    }
}

echo PHP_EOL;
var_export($res);
echo PHP_EOL;