<?php

class CertGenerator
{
    public string $pathTemplate = __DIR__ . '/../template';
    public CertConfig $config;
    public array $stackCommands = [];

    public function __construct(array $config = [])
    {
        $this->config = new CertConfig();

        foreach ($config as $k => $v) {
            $this->config->$k = $v;
        }
    }

    public function go()
    {

    }

    public function buildCommand($template, $data)
    {
        $folder = $this->pathTemplate;
        $file = $template;
        $path = realpath("{$folder}/{$file}");
        return BorgTemplate::render($path, $data);
    }
}