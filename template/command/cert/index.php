<?php

$data = new stdClass();

$data->CN = 'XXX';
$data->O = 'XXX';
$data->fileCaKey = 'XXX';
$data->fileCaKeyCaPem = 'XXX';
$data->DNS1 = 'XXX';
$data->DNS2 = 'XXX';
$data->IP1 = 'XXX';
$data->fileServerKey = 'XXX';
$data->fileCsr = 'XXX';
$data->fileCrt = 'XXX';
$data->fileExtfile = 'XXX';

# Generate Private Key                          [borg_ca.key]
# Generate Root Certificate                     [borg_ca.pem]
# Generate the Server Certificate
## Create Configuration File                    [borg.home.ext]
## Generate Server Key                          [borg.home.key]
## Generate CSR                                 [borg.home.csr]
## Sign Certificate with CA                     [borg.home.crt]
