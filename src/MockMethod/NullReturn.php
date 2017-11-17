<?php

namespace Amock\MockMethod;

class NullReturn extends Handler
{
    public function handle(): bool
    {
        if (!$this->canHandle()) {
            return false;
        }

        $this->initialStub
            ->method($this->methodName)
            ->willReturn(null);

        return true;
    }

    private function canHandle(): bool
    {
        return is_string($this->methodMockConfig)
            && substr($this->methodMockConfig, 0, 5) === '@null';
    }
}
