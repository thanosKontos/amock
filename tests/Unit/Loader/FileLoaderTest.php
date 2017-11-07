<?php

namespace Amock\Loader;

use PHPUnit\Framework\TestCase;

class FileLoaderTest extends TestCase
{
    public function testSuccessfulLoadNoExtension()
    {
        $directoryLoader = new FileLoader(__DIR__ . '/../../fixtures/sampleYamlDir/other');

        $this->assertNotEmpty($directoryLoader->get());
    }

    public function testSuccessfulLoadWithExtension()
    {
        $directoryLoader = new FileLoader(__DIR__ . '/../../fixtures/sampleYamlDir/other.yml');

        $this->assertNotEmpty($directoryLoader->get());
    }
}
