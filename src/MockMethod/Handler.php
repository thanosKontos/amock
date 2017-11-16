<?php

namespace Amock\MockMethod;

use PHPUnit\Framework\TestCase;

abstract class Handler
{
    private $successor;

    protected $testCase;

    protected $initialStub;

    protected $methodName;

    protected $methodMockConfig;

    public function __construct(TestCase $testCase, $initialStub, string $methodName, $methodMockConfig)
    {
        $this->testCase = $testCase;
        $this->initialStub = $initialStub;
        $this->methodName = $methodName;
        $this->methodMockConfig = $methodMockConfig;
    }

    abstract public function handle(): bool;
 
    public function setSuccessor($nextService)
    {
        $this->successor = $nextService;
    }

    public function process(): bool
    {
        $handleResult = $this->handle();
        if (false === $handleResult && $this->successor) {
            $handleResult = $this->successor->process();
        }

        return $handleResult;
    }
}
