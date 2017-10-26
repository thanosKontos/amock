<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class Amock
{
    private $loader;

    private $parser;

    private $mock;

    public static function create(Configuration $config, TestCase $testCase): Amock
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

        return new Amock($loader, $parser, new Mock($testCase));
    }

    public function __construct(
        Loader\Loader $loader,
        Parser\Parser $parser,
        Mock $mock
    ) {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->mock = $mock;
    }

    public function get(string $objectId)
    {
        $rawObject = $this->loader->get();
        $mockObjectArray = $this->parser->parse($rawObject);
        $this->mock->setMockArray($mockObjectArray[$objectId]);

        return $this->mock->get();
    }
}
