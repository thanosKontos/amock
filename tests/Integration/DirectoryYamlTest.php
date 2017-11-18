<?php

namespace Amock\Loader;

use PHPUnit\Framework\TestCase;
use Amock\Configuration;
use Amock\Amock;

class DirectoryYamlTest extends TestCase
{
    public function testSuccessfulGetMockOne()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertEquals('Something', $amockMock->sampleMethodReturningString());
    }

    /**
     * @expectedException Fixtures\SampleException
     */
    public function testSuccessfulGetMockTwo()
    {
        $config = new Configuration('yaml', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockException');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $amockMock->sampleMethodReturningString();
    }
}
