<?php

namespace Amock\MockMethod;

class BooleanReturn extends Handler
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
            && substr($this->methodMockConfig, 0, 9) === '@boolean:';
    }

    private function returnValue(): bool
    {
        return filter_var(substr($this->methodMockConfig, 9), FILTER_VALIDATE_BOOLEAN);
    }
}
