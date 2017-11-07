<?php

namespace Amock\Parser;

use ArrayAccess;
use Symfony\Component\Yaml\Yaml;

class YamlParser implements Parser, ArrayAccess
{
    private $parsed = [];

    public function parse(string $rawYaml): void
    {
        foreach ($this->yamlToArray($rawYaml) as $className => $yamlArray) {
            foreach ($yamlArray as $id => $mockArray) {
                $this->parsed[$id] = [$className => $mockArray];
            }
        }
    }

    protected function yamlToArray(string $rawYaml): array
    {
        if (function_exists('yaml_parse')) {
            return yaml_parse($rawYaml);
        }

        return Yaml::parse($rawYaml);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->parsed[] = $value;
        } else {
            $this->parsed[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->parsed[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->parsed[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->parsed[$offset]) ? $this->parsed[$offset] : null;
    }
}
