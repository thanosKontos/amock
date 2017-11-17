<?php

namespace Amock\MockMethod;

class StringReturn extends Handler
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
            && substr($this->methodMockConfig, 0, 8) === '@string:';
    }

    private function returnValue(): string
    {
        return substr($this->methodMockConfig, 8);
    }
}
