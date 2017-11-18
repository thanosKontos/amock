<?php

namespace Fixtures;

class SampleClass
{
    public function __construct()
    {
        $bbb = 222;
    }

    public function sampleMethodReturningString(): string
    {
        return 'abc';
    }

    public function sampleMethodReturningInteger(): int
    {
        return 123;
    }

    public function sampleMethodReturningArray(): array
    {
        return ['123', '456'];
    }

    public function sampleMethodReturningBoolean(): bool
    {
        return true;
    }

    public function otherSampleMethod()
    {
        return true;
    }
}
