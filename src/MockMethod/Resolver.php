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
        $stringReturn = new StringReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $integerReturn = new IntegerReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $arrayReturn = new ArrayReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $nullReturn = new NullReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $selfReturn = new SelfReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $consecutiveCallsReturn = new ConsecutiveCallsReturn($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
        $exceptionThrow = new ExceptionThrow($this->testCase, $this->initialStub, $this->methodName, $this->methodMockConfig);
    
        $stringReturn->setSuccessor($arrayReturn);
        $arrayReturn->setSuccessor($nullReturn);
        $nullReturn->setSuccessor($selfReturn);
        $selfReturn->setSuccessor($integerReturn);
        $integerReturn->setSuccessor($consecutiveCallsReturn);
        $consecutiveCallsReturn->setSuccessor($exceptionThrow);

        return $stringReturn->process();
    }
}

