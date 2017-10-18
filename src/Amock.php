<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class Amock
{
    private $loader;

    private $parser;

    public static function create(Configuration $config): Amock
    {
        $sourceType = $config->getSourceType();
        $type = $config->getType();

        switch ($sourceType) {
            case Configuration::SOURCE_TYPE_DIR:
                $loader = new Loader\DirectoryLoader($config->getValue());
                break;
            default:
                throw new Exception\InvalidLoaderException($sourceType);
        }

        switch ($type) {
            case Configuration::TYPE_YAML:
                $parser = new Parser\YamlParser();
                break;
            default:
                throw new Exception\InvalidParserException($type);
        }

        return new Amock($loader, $parser);
    }

    public function __construct(Loader\Loader $loader, Parser\Parser $parser)
    {
        $this->loader = $loader;
        $this->parser = $parser;
    }

    public function get(string $objectId, TestCase $testCase)
    {
        $rawObject = $this->loader->get();
        $mockObjectArray = $this->parser->parse($rawObject);

        return $this->getMockObject($mockObjectArray[$objectId], $testCase);
    }

    private function getMockObject(array $mockArray, TestCase $testCase)
    {
        $className = key($mockArray);

        if ($mockArray[$className]['disableConstructor'] == true) {
            $stub = $testCase->getMockBuilder($className)
                ->disableOriginalConstructor()
                ->getMock();
        } else {
            $stub = $testCase->getMockBuilder($className)
                ->getMock();
        }

        foreach ($mockArray[$className]['mockMethods'] as $methodName => $returnValue) {
            $stub->method($methodName)
                ->willReturn($returnValue);
        }

        return $stub;
    }
}
