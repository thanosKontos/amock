<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testMockToReturnValue()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
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
     * @expectedException Fixtures\SampleException
     */
    public function testMockToReturnException()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@exception:\Fixtures\SampleException'
                ]
            ]
        ];

        $mock = new Mock($this);
        $mock->setMockArray($mockArray);

        $mockClass = $mock->get();
        $mockClass->method1();
    }
}
