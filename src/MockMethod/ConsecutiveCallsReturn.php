<?php

namespace Amock\MockMethod;

class ConsecutiveCallsReturn extends Handler
{
    public function handle(): bool
    {
        if (!$this->canHandle()) {
            return false;
        }

        $this->initialStub->method($this->methodName)->will(
            call_user_func_array([$this->testCase, 'onConsecutiveCalls'], $this->methodMockConfig)
        );

        return true;
    }

    private function canHandle(): bool
    {
        return is_array($this->methodMockConfig);
    }
}
