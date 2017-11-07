<?php

namespace Amock\Loader;

class LoaderFactory
{
    const SOURCE_TYPE_DIR = 'dir';

    const SOURCE_TYPE_FILE = 'file';

    public static function create(string $sourceType, string $value): Loader
    {
        switch ($sourceType) {
            case static::SOURCE_TYPE_DIR:
                return new DirectoryLoader($value);
            case static::SOURCE_TYPE_FILE:
                return new FileLoader($value);
            default:
                throw new Exception\InvalidLoaderException($sourceType);
        }
    }
}
