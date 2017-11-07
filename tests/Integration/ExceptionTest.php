<?php

namespace Amock\Loader;

use PHPUnit\Framework\TestCase;
use Amock\Configuration;
use Amock\Amock;

class ExceptionTest extends TestCase
{
    /**
     * @expectedException Amock\Parser\Exception\InvalidParserException
     * @expectedExceptionMessage Invalid parser type provided: ini
     */
    public function testShouldThrowParserException()
    {
        $config = new Configuration('ini', 'dir', __DIR__ . '/../fixtures/sampleYamlDir');
        Amock::create($config, $this);
    }

    /**
     * @expectedException Amock\Loader\Exception\InvalidLoaderException
     * @expectedExceptionMessage Invalid loader type provided: other
     */
    public function testShouldThrowLoaderException()
    {
        $config = new Configuration('yaml', 'other', __DIR__ . '/../fixtures/sampleYamlDir');
        Amock::create($config, $this);
    }
}
