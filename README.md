# Amock - Organize your mock objects in configuration files (yaml/ini) for phpunit

[![Latest Stable Version](https://poser.pugx.org/thanos-kontos/amock/v/stable)](https://packagist.org/packages/thanos-kontos/amock)
[![Build Status](https://travis-ci.org/thanosKontos/amock.svg?branch=master)](https://travis-ci.org/thanosKontos/amock)

## Release notes

**Under development. Do not use!**

## Instructions

`composer require --dev thanosKontos/amock`

Add a directory to store your fixtures e.g. `tests/mock_fixtures` and as as many yaml files as you want.

```yaml
# tests/mock_fixtures/repositories.yml

MyProject\Library\UserRepository:
  mockUserRepository:
    disableConstructor: true
    mockMethods:
      insert: '@value:null'
      update: '@value:null'
MyProject\Library\ProductRepository:
  mockProductRepository:
    disableConstructor: true
    mockMethods:
      insert: '@value:null'
      update: '@value:null'
```

```yaml
# tests/mock_fixtures/gateways.yml

MyProject\Library\SomeApiGateway:
  mockSuccessResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@value:{"hello":"world"}'
  mock404Response:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@value:{"error": "404","message":"Not found"}'
  mockExceptionResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@exception:\MyProject\Library\Exception\ApiException'
```

On your test bootstrap file

```php
$config = new \Amock\Configuration(
    \Amock\Configuration::TYPE_YAML,
    \Amock\Configuration::SOURCE_TYPE_DIR,
    '/path/to/mock_fixtures'
);

$amock = \Amock\Amock::create($config, $testCase);
```

Then you can use the configured mocks in your tests:

```php
$stub = $amock->get('mock404Response');
```

# Example

There is an dummy project [here](https://github.com/thanosKontos/amock-example) that you can use as a reference.


## License

Amock is released under the [MIT License](https://opensource.org/licenses/MIT).