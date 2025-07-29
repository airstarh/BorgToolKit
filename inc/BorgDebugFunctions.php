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

if (!function_exists('plog')) {
    function plog($data, $doTrace = true)
    {
        BorgDebug::fDebug($data, true, null, 'php');
    }
}

if (!function_exists('plogSd')) {
    function plogSd($data = null)
    {
        register_shutdown_function(function () use ($data) {
            plog($data);
        });
    }
}


if (!function_exists('plogBack')) {
    function plogBack()
    {
        $data = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT);
        plog($data);
    }
}

if (!function_exists('borgCountSome1')) {
    function borgCountSome1()
    {
        return BorgDebug::$countSome1++;
    }
}

if (!function_exists('borgCountSome2')) {
    function borgCountSome2()
    {
        return BorgDebug::$countSome2++;
    }
}

if (!function_exists('borgCountSome3')) {
    function borgCountSome3()
    {
        return BorgDebug::$countSome3++;
    }
}
