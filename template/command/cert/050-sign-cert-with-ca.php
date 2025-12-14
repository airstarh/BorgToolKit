<?php
/**
 * Sign Certificate with CA:
 * openssl x509 -req -in borg.home.csr -CA borg_ca.pem -CAkey borg_ca.key -CAcreateserial -out borg.home.crt -days 365 -sha256 -extfile borg.home.ext
 */

/**
 * @var object $data
 */

$in = $data->fileCsr; //FILE eg: borg.home.csr
$CA = $data->fileCaKeyCaPem; //FILE eg: borg_ca.pem
$CAkey = $data->fileCaKey; //FILE eg: borg_ca.key
$out = $data->fileCrt; //FILE eg: borg.home.crt
$extfile = $data->fileExtfile; //FILE CONFIGURATION from 020-ext-configuration.php. eg: borg.home.ext
?>
openssl x509 -req -in <?= $in ?> -CA <?= $CA ?> -CAkey <?= $CAkey ?> -CAcreateserial -out <?= $out ?> -days 365 -sha256 -extfile <?= $extfile ?>