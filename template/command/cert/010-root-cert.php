<?php
/**
 * Generate Root Certificate
 * openssl req -x509 -new -nodes -key borg_ca.key -sha256 -days 3650 -out borg_ca.pem -subj "/C=US/ST=Local/L=Local/O=Borg Home CA/CN=borg.home Root CA"
 */

/**
 * @var object $data
 */

$key = $data->fileCaKey; //FILE eg: borg_ca.key
$CN = $data->CN; // eg: borg.home
$O = $data->O; // eg: Borg Home
$out = $data->fileCaKeyCaPem; //FILE eg: borg_ca.pem
?>
openssl req -x509 -new -nodes -key <?= $key ?> -sha256 -days 3650 -out <?= $out ?> -subj "/C=US/ST=Local/L=Local/O=<?= $O ?> CA/CN=<?= $CN ?> Root CA"