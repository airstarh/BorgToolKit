<?php
/**
 * Generate the Server Certificate (WSL)
 * Create Configuration File (borg.home.ext):
 */

/**
 * @var CertConfig $data
 */

$DNS1 = $data->DNS1; // eg: borg.home
$DNS2 = $data->DNS2; // eg: x.borg.home
$IP1 = $data->IP; // eg: 192.168.1.120
?>
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = <?= $DNS1; ?><?= PHP_EOL ?>
DNS.2 = <?= $DNS2; ?><?= PHP_EOL ?>
IP.1 = <?= $IP1; ?>