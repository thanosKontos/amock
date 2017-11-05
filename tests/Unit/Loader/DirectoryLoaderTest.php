<?php

namespace Amock\Loader;

use PHPUnit\Framework\TestCase;

class DirectoryLoaderTest extends TestCase
{
    public function testSuccessfulParsing()
    {
        $directoryLoader = new DirectoryLoader(__DIR__ . '/../../fixtures/sampleYamlDir');

        $this->assertNotEmpty($directoryLoader->get());
    }
}
