<?php

class CertGenerator
{
    public string $pathTemplate = CERT_ROOT . '/template';
    public CertConfig $config;
    public array $stackTemplate = [
        '100-ca-private-key.php',
        '200-root-pem.php',
        '300-ext-configuration.php',
        '400-server-key.php',
        '500-csr.php',
        '600-crt.php',
    ];
    public array $stackCommand = [];

    public function __construct(array $config = [])
    {
        $this->config = new CertConfig();

        foreach ($config as $k => $v) {
            $this->config->$k = $v;
        }
    }

    public function go()
    {
        $counter = 0;
        foreach ($this->stackTemplate as $template) {
            $counter++;
            $command = $this->buildCommand($template);
            $this->stackCommand[] = $command;
            $distFile = $this->config->dist . DIRECTORY_SEPARATOR . "res-{$counter}";
            file_put_contents($distFile, $command);
        }
        BorgDebug::dumpBeautiful($this->stackCommand[2]);

    }

    public function buildCommand($template)
    {
        $folder = $this->pathTemplate;
        $file = $template;
        $path = realpath("{$folder}/{$file}");
        return BorgTemplate::render($path, $this->config);
    }
}