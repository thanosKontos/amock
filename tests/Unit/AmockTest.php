<?php

namespace Amock;

use PHPUnit\Framework\TestCase;

class AmockTest extends TestCase
{
    public function testConstruction()
    {
        $amock = new Amock(
            $this->getLoaderStub(),
            $this->getParserStub(),
            $this->getMockStub()
        );

        $amock->get('Classname');
    }

    private function getLoaderStub()
    {
        $loaderStub = $this->getMockBuilder(Loader\DirectoryLoader::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $loaderStub->method('get')
             ->willReturn('');

        return $loaderStub;
    }

    private function getParserStub()
    {
        $parserStub = $this->getMockBuilder(Parser\YamlParser::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $parserStub->method('parse')
             ->willReturn(null);

        $parserStub->method('offsetGet')
             ->willReturn([]);

        return $parserStub;
    }

    private function getMockStub()
    {
        $mockStub = $this->getMockBuilder(StubConfiguration::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $mockStub->method('setStubConfigurationArray')
             ->willReturn([]);

        return $mockStub;
    }
}
