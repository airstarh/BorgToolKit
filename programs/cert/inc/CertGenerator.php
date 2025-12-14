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

        foreach ($this->config as $field => $v) {
            $value = $config[$field] ?? $v;
            $this->config->$field = $value;
        }

        foreach ($this->config as $field => $v) {
            if (false !== strpos($field, 'file')) {
                $path = [
                    $this->config->dist,
                    $v
                ];
                $this->config->$field = implode(DIRECTORY_SEPARATOR, $path);
            }
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
        BorgDebug::dumpBeautiful($this->stackCommand);

    }

    public function buildCommand($template)
    {
        $folder = $this->pathTemplate;
        $file = $template;
        $path = realpath("{$folder}/{$file}");
        return BorgTemplate::render($path, $this->config);
    }
}