<?php

namespace Amock\Loader;

use PHPUnit\Framework\TestCase;
use Amock\Configuration;
use Amock\Amock;

class MockingMethodsTest extends TestCase
{
    public function testSuccessfulMethodReturnString()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertSame('Something', $amockMock->sampleMethodReturningString());
    }

    public function testSuccessfulMethodReturnInteger()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertSame(321, $amockMock->sampleMethodReturningInteger());
    }

    public function testSuccessfulMethodReturnArray()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertSame(['111' => 'aaa', '222' => 'bbb'], $amockMock->sampleMethodReturningArray());
    }

    public function testSuccessfulMethodReturnBoolean()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertSame(false, $amockMock->sampleMethodReturningBoolean());
    }

    public function testSuccessfulMethodReturnDifferentConsecutively()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertSame('bbb', $amockMock->otherSampleMethod());
        $this->assertSame('{test: abc}', $amockMock->otherSampleMethod());
        $this->assertSame(123, $amockMock->otherSampleMethod());
    }
}
