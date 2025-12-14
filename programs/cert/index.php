<?php

require_once '../../index.php';

$dirInc = __DIR__ . '/inc';
$listDir = scandir($dirInc);
foreach ($listDir as $f) {
    if ($f === '.' || $f === '..')
        continue;
    require_once "$dirInc/$f";
}

$program = new CertGenerator();

