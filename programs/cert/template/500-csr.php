<?php
/**
 * Generate CSR
 * openssl req -new -key borg.home.key -out borg.home.csr -subj "/C=US/ST=Local/L=Local/O=Borg Home/CN=borg.home"
 */

/**
 * @var CertConfig $data
 */

$key = $data->fileServerKey; //FILE eg: borg.home.key
$out = $data->fileCsr; //FILE eg: borg.home.csr
$O = $data->O; // eg: Borg Home
$CN = $data->CN; // eg: borg.home
?>
openssl req -new -key <?= $key ?> -out <?= $out ?> -subj "/C=US/ST=Local/L=Local/O=<?= $O ?>/CN=<?= $CN ?>"