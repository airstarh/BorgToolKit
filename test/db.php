<?php
require_once __DIR__ . '/../index.php';

$data = BorgDb::checkAll();
ffj($data);

?>