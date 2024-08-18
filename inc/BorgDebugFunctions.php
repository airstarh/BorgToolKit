<?php

require_once __DIR__ . '/BorgDebug.php';

if (!function_exists('fff')) {
    function fff($data)
    {
        BorgDebug::fDebug($data, false, null, null);
    }
}

if (!function_exists('ffff')) {
    function ffff($data)
    {
        BorgDebug::fDebug($data, false, null, 'json');
    }
}

if (!function_exists('ff')) {
    function ff($data)
    {
        fff($data);
        ffff($data);
    }
}

if (!function_exists('ffd')) {
    function ffd($data)
    {
        BorgDebug::dDebug($data);
    }
}

if (!function_exists('flog')) {
    function flog($data)
    {
        BorgDebug::fDebug($data, true, BORG_ROOT . DIRECTORY_SEPARATOR . 'DEBUGLOG.html', null);
    }
}

if (!function_exists('ffj')) {
    function ffj($data)
    {
        BorgDebug::jDebug($data);
    }
}