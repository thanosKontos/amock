<?php

namespace Amock\MockMethod;

class IntegerReturn extends Handler
{
    public function handle(): bool
    {
        if (!$this->canHandle()) {
            return false;
        }

        $this->initialStub
            ->method($this->methodName)
            ->willReturn($this->returnValue());

        return true;
    }

    private function canHandle(): bool
    {
        return is_string($this->methodMockConfig)
            && substr($this->methodMockConfig, 0, 9) === '@integer:';
    }

    private function returnValue(): int
    {
        return intval(substr($this->methodMockConfig, 9));
    }
}
