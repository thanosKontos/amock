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
            call_user_func_array([$this->testCase, 'onConsecutiveCalls'], $this->transformValue())
        );

        return true;
    }

    private function canHandle(): bool
    {
        return is_array($this->methodMockConfig);
    }

    private function transformValue()
    {
        array_walk($this->methodMockConfig, function(&$value, &$key) {
            $value = (substr($value, 0, 8) === '@string:') ? substr($value, 8) : $value;
            $value = (substr($value, 0, 9) === '@integer:') ? intval(substr($value, 9)) : $value;
            $value = (substr($value, 0, 9) === '@boolean:') ? filter_var(substr($value, 9), FILTER_VALIDATE_BOOLEAN) : $value;
        });

        return $this->methodMockConfig;
    }
}
