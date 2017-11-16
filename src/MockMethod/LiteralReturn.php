<?php

namespace Amock\MockMethod;

class LiteralReturn extends Handler
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
            && substr($this->methodMockConfig, 0, 9) === '@literal:';
    }

    private function returnLiteral()
    {
        eval('$literal = ' . substr($this->methodMockConfig, 9) . ';');

        return $literal;
    }
}
