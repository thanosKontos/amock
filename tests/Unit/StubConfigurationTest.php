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
                    'sampleMethodReturningString' => '@string:{"111":"aaa","222":"bbb"}'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame('{"111":"aaa","222":"bbb"}', $mockClass->sampleMethodReturningString());
    }

    public function testMockToReturnArray()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'sampleMethodReturningArray' => '@array:{"111":"aaa","222":"bbb"}'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(["111" => "aaa", "222" => "bbb"], $mockClass->sampleMethodReturningArray());
    }

    public function testMockToReturnNull()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'otherSampleMethod' => '@null'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(null, $mockClass->otherSampleMethod());
    }

    public function testMockToReturnInteger()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'sampleMethodReturningInteger' => '@integer:15'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(15, $mockClass->sampleMethodReturningInteger());
    }

    public function testMockToReturnTrue()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'sampleMethodReturningBoolean' => '@boolean:true'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(true, $mockClass->sampleMethodReturningBoolean());
    }

    public function testMockToReturnFalse()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'sampleMethodReturningBoolean' => '@boolean:false'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame(false, $mockClass->sampleMethodReturningBoolean());
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
                    'otherSampleMethod' => '@exception:\Fixtures\SampleException'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $mockClass->otherSampleMethod();
    }

    public function testMockToReturnSelf()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'otherSampleMethod' => '@self'
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertSame($mockClass, $mockClass->otherSampleMethod());
    }

    public function testMockToReturnConsecutiveValues()
    {
        $mockArray = [
            'Fixtures\SampleClass' => [
                'disableConstructor' => true,
                'mockMethods' => [
                    'otherSampleMethod' => ['@string:aaa', '@integer:2', '@boolean:true']
                ]
            ]
        ];

        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray($mockArray);

        $mockClass = $mock->getStub();
        $this->assertEquals('aaa', $mockClass->otherSampleMethod());
        $this->assertEquals(2, $mockClass->otherSampleMethod());
        $this->assertEquals(true, $mockClass->otherSampleMethod());
    }

    /**
     * @expectedException Amock\Parser\Exception\ParseException
     */
    public function testNoConfigurationGivesException()
    {
        $mock = new StubConfiguration($this);
        $mock->setStubConfigurationArray([]);

        $mock->getStub();
    }
}
