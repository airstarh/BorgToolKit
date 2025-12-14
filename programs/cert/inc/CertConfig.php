<?php

class CertConfig
{
    public $dist = CERT_ROOT . '/dist';
    public $CN = 'borg.home';
    public $O = 'Borg Home';
    public $fileCaPrivateKey = 'borg_ca.key';
    public $fileRootCertificatePem = 'borg_ca.pem';
    public $DNS = [
        'borg.home',
        'x.borg.home',
    ];
    public $IP = [
        '127.0.0.1',
        '192.168.2.104',
    ];
    public $fileServerKey = 'borg.home.key';
    public $fileCsr = 'borg.home.csr';
    public $fileCrt = 'borg.home.crt';
    public $fileExtfile = 'borg.home.ext';
}