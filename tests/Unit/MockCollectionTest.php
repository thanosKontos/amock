<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class StubConfigurationTest extends TestCase
{
    public function testMockToReturnString()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@string:{"111":"aaa","222":"bbb"}'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame('{"111":"aaa","222":"bbb"}', $mockClass->method1());
    }

    public function testMockToReturnArray()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@array:{"111":"aaa","222":"bbb"}'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(["111" => "aaa", "222" => "bbb"], $mockClass->method1());
    }

    public function testMockToReturnNull()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@null'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(null, $mockClass->method1());
    }

    public function testMockToReturnInteger()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@integer:15'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(15, $mockClass->method1());
    }

    public function testMockToReturnTrue()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@boolean:true'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(true, $mockClass->method1());
    }

    public function testMockToReturnFalse()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'method1' => '@boolean:false'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(false, $mockClass->method1());
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
                    'method1' => ['@string:aaa', '@integer:2', '@boolean:true']
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
