<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class StubConfiguration
{
    private $stubConfiguration;

    private $testCase;

    private $className;

    public function __construct(TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    public function setStubConfigurationArray(array $stubConfiguration): void
    {
        $this->stubConfiguration = $stubConfiguration;
        $this->className = $this->getMockClassName($stubConfiguration);
    }

    public function getStub()
    {
        if (empty($this->stubConfiguration)) {
            throw new Parser\Exception\ParseException();
        }

        $stub = $this->getInitialStub();

        foreach ($this->stubConfiguration[$this->className]['mockMethods'] as $methodName => $methodMockConfig) {
            (new MockMethod\Resolver($this->testCase, $stub, $methodName, $methodMockConfig))
                ->resolveAndModifyStub();
        }

        return $stub;
    }

    private function getInitialStub()
    {
        $disableConstructor = $this->stubConfiguration[$this->className]['disableConstructor'] ?? false;

        if ($disableConstructor) {
            return $this->testCase->getMockBuilder($this->className)
                ->disableOriginalConstructor()
                ->getMock();
        }

        return $this->testCase->getMockBuilder($this->className)
            ->getMock();
    }

    private function getMockClassName()
    {
        return key($this->stubConfiguration);
    }
}

