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
        $loader = Loader\LoaderFactory::create(
            $config->getSourceType(),
            $config->getValue()
        );

        $parser = Parser\ParserFactory::create($config->getType());

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
        $this->parser->parse($this->loader->get());
        $this->mock->setMockArray($this->parser[$objectId]);

        return $this->mock->get();
    }
}
