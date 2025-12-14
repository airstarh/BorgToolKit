<?php
define("CERT_ROOT", __DIR__);
require_once CERT_ROOT . '/../../index.php';

$dirInc = __DIR__ . '/inc';
$listDir = scandir($dirInc);
foreach ($listDir as $f) {
    if ($f === '.' || $f === '..')
        continue;
    require_once "$dirInc/$f";
}

$program = new CertGenerator();
$program->go();
