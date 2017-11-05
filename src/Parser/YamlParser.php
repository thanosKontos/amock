<?php

namespace Amock\Parser;

use Symfony\Component\Yaml\Yaml;

class YamlParser implements Parser
{
    public function parse(string $rawYaml): array
    {
        $reorderedObject = [];
        foreach ($this->yamlToArray($rawYaml) as $className => $yamlArray) {
            foreach ($yamlArray as $id => $mockArray) {
                $reorderedObject[$id] = [$className => $mockArray];
            }
        }

        return $reorderedObject;
    }

    protected function yamlToArray(string $rawYaml): array
    {
        if (function_exists('yaml_parse')) {
            return yaml_parse($rawYaml);
        }

        return Yaml::parse($rawYaml);
    }
}
