<?php

namespace Amock\Parser;

class ParserFactory
{
    const TYPE_YAML = 'yaml';

    public static function create(string $type): Parser
    {
        switch ($type) {
            case static::TYPE_YAML:
                return new YamlParser();
            default:
                throw new Exception\InvalidParserException($type);
        }
    }
}
