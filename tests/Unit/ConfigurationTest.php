<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConstruction()
    {
        $configuration = new Configuration('aaa', 'bbb', 'ccc');

        $this->assertEquals('aaa', $configuration->getType());
        $this->assertEquals('bbb', $configuration->getSourceType());
        $this->assertEquals('ccc', $configuration->getValue());
    }
}
