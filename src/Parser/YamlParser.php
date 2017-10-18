<?php

namespace Amock\Parser;

class YamlParser implements Parser
{
    public function parse(string $rawYaml): array
    {
        $yaml = yaml_parse($rawYaml);

        $reorderedObject = [];
        foreach ($yaml as $className => $yamlArray) {
            foreach ($yamlArray as $id => $mockArray) {
                $reorderedObject[$id] = [$className => $mockArray];
            }
        }

        return $reorderedObject;
    }
}
