<?php
require_once __DIR__ . '/../index.php';

try {
    throw new mysqli_sql_exception('ASAS');
} catch (mysqli_sql_exception $exception) {
    $msg = implode(" ", [
        'Exception on ',
        __METHOD__,
        'Line:', $exception->getLine(),
        'Message:', $exception->getMessage(),
    ]);

    echo $msg;
}

BorgDebug::dumpBeautiful(explode('/', ''));