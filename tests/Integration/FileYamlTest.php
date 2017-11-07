<?php

namespace Amock\Loader;

use PHPUnit\Framework\TestCase;
use Amock\Configuration;
use Amock\Amock;

class FileYamlTest extends TestCase
{
    public function testSuccessfulNoExtension()
    {
        $config = new Configuration('yaml', 'file', __DIR__ . '/../fixtures/sampleYamlDir/other');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertEquals('Something', $amockMock->method1());
    }

    public function testSuccessfulWithExtension()
    {
        $config = new Configuration('yaml', 'file', __DIR__ . '/../fixtures/sampleYamlDir/other.yml');
        $amock = Amock::create($config, $this);

        $amockMock = $amock->get('sampleClassMockValue');

        $this->assertInstanceOf('Fixtures\SampleClass', $amockMock);
        $this->assertEquals('Something', $amockMock->method1());
    }
}
