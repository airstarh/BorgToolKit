<?php

class CertConfig
{
    public $dist = CERT_ROOT . '/dist';
    public $CN = 'borg.home';
    public $O = 'Borg Home';
    public $fileCaPrivateKey = 'borg_ca.key';
    public $fileRootCertificatePem = 'borg_ca.pem';
    public $DNS1 = 'borg.home';
    public $DNS2 = 'x.borg.home';
    public $IP = '192.168.1.120';
    public $fileServerKey = 'borg.home.key';
    public $fileCsr = 'borg.home.csr';
    public $fileCrt = 'borg.home.crt';
    public $fileExtfile = 'borg.home.ext';
}