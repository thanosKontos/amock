<?php

namespace Amock\Loader;

class FileLoader implements Loader
{
    private $filepath;

    public function __construct(string $filepath)
    {
        $this->filepath = $this->getFilepathWithExtension($filepath);
    }

    public function get(): string
    {
        return file_get_contents($this->filepath);
    }

    private function getFilepathWithExtension($filepath)
    {
        return strrpos($filepath, '.yml', -4) === false
            ? $filepath . '.yml'
            : $filepath;
    }
}
