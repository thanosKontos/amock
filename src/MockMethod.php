<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class MockMethod
{
    private $initialStub;

    private $methodName;

    private $methodMockConfig;

    private $testCase;

    public function __construct(TestCase $testCase, $initialStub, string $methodName, $methodMockConfig)
    {
        $this->initialStub = $initialStub;
        $this->methodName = $methodName;
        $this->testCase = $testCase;
        $this->methodMockConfig = $methodMockConfig;
    }

    public function addMockMethodToStub()
    {
        if (is_array($this->methodMockConfig)) {
            $this->initialStub->method($this->methodName)->will(
                call_user_func_array([$this->testCase, 'onConsecutiveCalls'], $this->methodMockConfig)
            );

            return;
        }

        if ($this->shouldReturnValue($this->methodMockConfig)) {
            $this->initialStub->method($this->methodName)->willReturn($this->returnValue($this->methodMockConfig));

            return;
        }

        if ($this->shouldThrowException($this->methodMockConfig)) {
            $exceptionClass = $this->exceptionClass($this->methodMockConfig);
            $this->initialStub->method($this->methodName)
                ->will($this->testCase->throwException(new $exceptionClass));

            return;
        }

        if ($this->shouldReturnSelf($this->methodMockConfig)) {
            $this->initialStub->method($this->methodName)->will($this->testCase->returnSelf());

            return;
        }
    }

    private function shouldReturnSelf($return): bool
    {
        return substr($return, 0, 5) === '@self';
    }

    private function shouldReturnValue($return): bool
    {
        return substr($return, 0, 7) === '@value:';
    }

    private function returnValue($return): string
    {
        return substr($return, 7);
    }

    private function shouldThrowException($return): bool
    {
        return substr($return, 0, 11) === '@exception:';
    }

    private function exceptionClass($return): string
    {
        return substr($return, 11);
    }
}

