<?php
/**
 * Generate the Server Certificate (WSL)
 * Create Configuration File (borg.home.ext):
 */

/**
 * @var object $data
 */

$DNS1 = $data->DNS1; // eg: borg.home
$DNS2 = $data->DNS2; // eg: x.borg.home
$IP1 = $data->IP1; // eg: 192.168.1.120
?>
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = <?= $DNS1 ?>
DNS.2 = <?= $DNS2 ?>
IP.1 = <?= $IP1 ?>