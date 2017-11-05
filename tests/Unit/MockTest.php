<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testMockToReturnValue()
    {
        $mockArray = [
            'Amock\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@value:xyz'
                ]
            ]
        ];

        $mock = new Mock($this);
        $mock->setMockArray($mockArray);

        $mockClass = $mock->get();
        $this->assertEquals('xyz', $mockClass->method1());
    }

    /**
     * @expectedException Amock\SampleException
     */
    public function testMockToReturnException()
    {
        $mockArray = [
            'Amock\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@exception:\Amock\SampleException'
                ]
            ]
        ];

        $mock = new Mock($this);
        $mock->setMockArray($mockArray);

        $mockClass = $mock->get();
        $mockClass->method1();
    }
}

class SampleClass
{
    public function method1()
    {
        return 'abc';
    }
}

class SampleException extends \Exception
{
}
