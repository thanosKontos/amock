<?php

namespace Amock\MockMethod;

class ExceptionThrow extends Handler
{
    public function handle(): bool
    {
        if (!$this->canHandle()) {
            return false;
        }

        $exceptionClass = $this->getExceptionClass();
        $this->initialStub->method($this->methodName)
            ->will($this->testCase->throwException(new $exceptionClass));

        return true;
    }

    private function canHandle(): bool
    {
        return is_string($this->methodMockConfig)
            && substr($this->methodMockConfig, 0, 11) === '@exception:';
    }

    private function getExceptionClass(): string
    {
        return substr($this->methodMockConfig, 11);
    }
}
