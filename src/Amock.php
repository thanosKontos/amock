<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class Amock
{
    private $loader;

    private $parser;

    private $stubConfiguration;

    public static function create(Configuration $config, TestCase $testCase): Amock
    {
        $loader = Loader\LoaderFactory::create(
            $config->getSourceType(),
            $config->getValue()
        );

        $parser = Parser\ParserFactory::create($config->getType());

        return new Amock($loader, $parser, new StubConfiguration($testCase));
    }

    public function __construct(
        Loader\Loader $loader,
        Parser\Parser $parser,
        StubConfiguration $stubConfiguration
    ) {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->stubConfiguration = $stubConfiguration;
    }

    public function get(string $objectId)
    {
        $this->parser->parse($this->loader->get());
        $this->stubConfiguration->setStubConfigurationArray($this->parser[$objectId]);

        return $this->stubConfiguration->getStub();
    }
}
