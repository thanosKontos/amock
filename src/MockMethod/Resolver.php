<?php

namespace Amock\MockMethod;

use PHPUnit\Framework\TestCase;

class Resolver
{
    private $testCase;

    private $initialStub;

    private $methodName;

    private $methodMockConfig;

    public function __construct(TestCase $testCase, $initialStub, string $methodName, $methodMockConfig)
    {
        $this->testCase = $testCase;
        $this->initialStub = $initialStub;
        $this->methodName = $methodName;
        $this->methodMockConfig = $methodMockConfig;
    }

    public function resolveAndModifyStub()
    {
        $valueReturn = new ValueReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $literalReturn = new LiteralReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $selfReturn = new SelfReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $consecutiveCallsReturn = new ConsecutiveCallsReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $exceptionThrow = new ExceptionThrow($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
    
        $valueReturn->setSuccessor($literalReturn);
        $literalReturn->setSuccessor($selfReturn);
        $selfReturn->setSuccessor($consecutiveCallsReturn);
        $consecutiveCallsReturn->setSuccessor($exceptionThrow);

        return $valueReturn->process();
    }
}

