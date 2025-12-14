<?php
/**
 * Generate Server Key
 * openssl genrsa -out borg.home.key 2048
 */

/**
 * @var object $data
 */

$out = $data->fileServerKey; //FILE eg: borg.home.key
?>
openssl genrsa -out <?= $out ?> 2048