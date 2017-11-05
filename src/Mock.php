<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class Mock
{
    private $mockArray;

    private $testCase;

    private $className;

    public function __construct(TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    public function setMockArray(array $mockArray): void
    {
        $this->mockArray = $mockArray;
        $this->className = $this->getMockClassName($mockArray);
    }

    public function get()
    {
        $mock = $this->getInitialMock();

        foreach ($this->mockArray[$this->className]['mockMethods'] as $methodName => $return) {
            if ($this->returnsValue($return)) {
                $mock->method($methodName)->willReturn($this->returnValue($return));
            }

            if ($this->throwsException($return)) {
                $exceptionClass = $this->exceptionClass($return);
                $mock->method($methodName)
                    ->will($this->testCase->throwException(new $exceptionClass));
            }
        }

        return $mock;
    }

    private function getInitialMock()
    {
        if ($this->mockArray[$this->className]['disableConstructor'] == true) {
            return $this->testCase->getMockBuilder($this->className)
                ->disableOriginalConstructor()
                ->getMock();
        }

        return $stub = $this->testCase->getMockBuilder($this->className)
            ->getMock();
    }

    private function getMockClassName()
    {
        return key($this->mockArray);
    }

    private function returnsValue($return): bool
    {
        return substr($return, 0, 7) === '@value:';
    }

    private function returnValue($return): string
    {
        return substr($return, 7);
    }

    private function throwsException($return): bool
    {
        return substr($return, 0, 11) === '@exception:';
    }

    private function exceptionClass($return): string
    {
        return substr($return, 11);
    }
}

