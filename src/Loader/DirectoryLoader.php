<?php

namespace Amock\Loader;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;

class DirectoryLoader implements Loader
{
    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function get(): string
    {
        $content = '';
        foreach($this->getFilesIterator() as $file) {
            $content .= file_get_contents(reset($file));
        }

        return $content;
    }

    private function getFilesIterator(): Iterator
    {
        $directoryIterator = new RecursiveDirectoryIterator($this->directory);
        $Iterator = new RecursiveIteratorIterator($directoryIterator);

        return new RegexIterator($Iterator, '/^.+\.[A-Z]+$/i', RecursiveRegexIterator::GET_MATCH);
    }
}
