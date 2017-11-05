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
             ->willReturn([
                 'Classname' => []
             ]);

        return $parserStub;
    }

    private function getMockStub()
    {
        $mockStub = $this->getMockBuilder(Mock::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $mockStub->method('setMockArray')
             ->willReturn(null);

        return $mockStub;
    }
}
