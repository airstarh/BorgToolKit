<?php

if (!function_exists('borgErrorLog')) {
    function borgErrorLog($data)
    {
        $prefix = 'SEWA_ERROR_LOG';
        $str = var_export($data, 1);
        $messageArray = [
            $prefix,
            PHP_EOL,
            $_SERVER['REQUEST_URI'],
            PHP_EOL,
            var_export($_GET, 1),
            PHP_EOL,
            var_export($_POST, 1),
            PHP_EOL,
            $str,
            PHP_EOL,
        ];
        $message = implode(PHP_EOL, $messageArray);
        error_log($message);
    }
}