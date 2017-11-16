<?php

namespace Amock\MockMethod;

class ValueReturn extends Handler
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
            && substr($this->methodMockConfig, 0, 7) === '@value:';
    }

    private function returnValue(): string
    {
        return substr($this->methodMockConfig, 7);
    }
}
