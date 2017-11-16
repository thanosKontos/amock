<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class StubConfigurationTest extends TestCase
{
    public function testMockToReturnSimpleValue()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@value:xyz'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertEquals('xyz', $mockClass->method1());
    }

    public function testMockToReturnLiteral()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@literal:["111" => "aaa", "222" => "bbb"]'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertEquals(["111" => "aaa", "222" => "bbb"], $mockClass->method1());
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

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $mockClass->method1();
    }

    public function testMockToReturnSelf()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@self'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame($mockClass, $mockClass->method1());
    }

    public function testMockToReturnConsecutiveValues()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => ['aaa', 2, true]
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertEquals('aaa', $mockClass->method1());
        $this->assertEquals(2, $mockClass->method1());
        $this->assertEquals(true, $mockClass->method1());
    }
}
