<?php

namespace Amock\MockMethod;

class ArrayReturn extends Handler
{
    public function handle(): bool
    {
        if (!$this->canHandle()) {
            return false;
        }

        $this->initialStub
            ->method($this->methodName)
            ->willReturn($this->returnLiteral());

        return true;
    }

    private function canHandle(): bool
    {
        return is_string($this->methodMockConfig)
            && substr($this->methodMockConfig, 0, 7) === '@array:';
    }

    private function returnLiteral()
    {
        return json_decode(substr($this->methodMockConfig, 7), true);
    }
}
