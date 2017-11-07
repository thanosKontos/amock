<?php

namespace Amock\Parser;

use PHPUnit\Framework\TestCase;

class YamlParserTest extends TestCase
{
    public function testSuccessfulParsing()
    {
        $rawYaml = <<<YAML
AmockExample\Library\SomeApiGateway:
  mockSuccessResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@value:{"hello":"world"}'
  mockExceptionResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@exception:\AmockExample\Library\Exception\ApiException'
YAML;

        $yamlParser = new YamlParser();
        $yamlParser->parse($rawYaml);

        $this->assertArrayHasKey('mockSuccessResponse', $yamlParser);
        $this->assertArrayHasKey('mockExceptionResponse', $yamlParser);

        $this->assertArrayHasKey('AmockExample\Library\SomeApiGateway', $yamlParser['mockSuccessResponse']);
        $this->assertTrue($yamlParser['mockSuccessResponse']['AmockExample\Library\SomeApiGateway']['disableConstructor']);
        $this->assertNotEmpty($yamlParser['mockSuccessResponse']['AmockExample\Library\SomeApiGateway']['mockMethods']);
    }
}
