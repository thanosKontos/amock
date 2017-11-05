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
        $parsed = $yamlParser->parse($rawYaml);

        $this->assertArrayHasKey('mockSuccessResponse', $parsed);
        $this->assertArrayHasKey('mockExceptionResponse', $parsed);

        $this->assertArrayHasKey('AmockExample\Library\SomeApiGateway', $parsed['mockSuccessResponse']);
        $this->assertTrue($parsed['mockSuccessResponse']['AmockExample\Library\SomeApiGateway']['disableConstructor']);
        $this->assertNotEmpty($parsed['mockSuccessResponse']['AmockExample\Library\SomeApiGateway']['mockMethods']);
    }
}
