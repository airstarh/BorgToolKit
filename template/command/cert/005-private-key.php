<?php
/**
 * Generate Private Key
 * openssl genrsa -out borg_ca.key 4096
 */

/**
 * @var object $data
 */

$out = $data->fileCaPrivateKey; //FILE eg: borg_ca.key
?>
openssl genrsa -out <?= $out ?> 4096