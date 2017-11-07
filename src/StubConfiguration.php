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
            throw new \Exception('Stub not configured');
        }

        $stub = $this->getInitialStub();

        foreach ($this->stubConfiguration[$this->className]['mockMethods'] as $methodName => $methodMockConfig) {
            $mockMethod = new MockMethod($this->testCase, $stub, $methodName, $methodMockConfig);
            $mockMethod->addMockMethodToStub();
        }

        return $stub;
    }

    private function getInitialStub()
    {
        if ($this->stubConfiguration[$this->className]['disableConstructor'] == true) {
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
