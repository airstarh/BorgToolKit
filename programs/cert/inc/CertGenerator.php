<?php
use function PHPUnit\Framework\returnArgument;
?><?php

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
                $this->config->$field = $this->distFile($v);
            }
        }
    }

    public function go()
    {
        foreach ($this->stackTemplate as $template) {
            if ($template === '300-ext-configuration.php') {
                $content = $this->buildCommand($template);
                file_put_contents($this->config->fileExtfile, $content);
                continue;
            }
            $command = $this->buildCommand($template);
            $this->stackCommand[] = $command;
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

    public function distFolder()
    {
        $parts = [
            $this->config->dist,
            $this->config->CN,
        ];
        $path = implode(DIRECTORY_SEPARATOR, $parts);
        $this->mkPathForce($path);
        return $path;
    }

    public function distFile(string $fileName)
    {
        $parts = [
            $this->distFolder(),
            $fileName,
        ];

        return implode(DIRECTORY_SEPARATOR, $parts);
    }
    public function mkPathForce(string $path)
    {
        if (!is_dir($path)) {
            if (!mkdir($path, 0755, true)) {
                die('Failed to create directories...');
            }
        }
    }
}