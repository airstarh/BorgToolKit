<?php
const BORG_PATH = __DIR__;
// define("BORG_ROOT", $_SERVER['DOCUMENT_ROOT'] ?: $_SERVER['PWD']);
define("BORG_ROOT", __DIR__);
$dirInc  = BORG_PATH . '/inc';
$listDir = scandir($dirInc);
foreach ($listDir as $f) {
    if ($f === '.' || $f === '..') continue;
    require_once "$dirInc/$f";
}
