<?php
require_once __DIR__ . '/../index.php';

$a = "ASD [A:1]";

$res = var_export($a, true);
$res = mysqli_real_escape_string(null, $a);

echo PHP_EOL;
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
###var_export($res);
echo($res);
echo PHP_EOL;
echo '##################################################';
echo PHP_EOL;
echo PHP_EOL;
