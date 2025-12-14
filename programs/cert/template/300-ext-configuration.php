<?php
/**
 * Generate the Server Certificate (WSL)
 * Create Configuration File (borg.home.ext):
 */

/**
 * @var CertConfig $data
 */

$DNS = $data->DNS;
$IP = $data->IP;
?>
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
<?php foreach ($DNS as $k => $v) { ?>
DNS.<?= $k+1 ?> = <?= $v; ?><?= PHP_EOL ?>
<?php } ?>
<?php foreach ($IP as $k => $v) { ?>
IP.<?= $k + 1 ?> = <?= $v; ?><?= PHP_EOL ?>
<?php } ?>