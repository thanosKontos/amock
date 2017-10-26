# Amock - Organize your mock objects in configuration files (yaml/ini) for phpunit

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
      insert: null
      update: null
MyProject\Library\ProductRepository:
  mockProductRepository:
    disableConstructor: true
    mockMethods:
      insert: null
      update: null
```

```yaml
# tests/mock_fixtures/gateways.yml

MyProject\Library\SomeApiGateway:
  mockSomeApiSuccessResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '{"hello":"world"}'
  mockSomeApi404Response:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '{"error": "404","message":"Not found"}'
```

On your test bootstrap file

```php
$config = new \Amock\Configuration(
    \Amock\Configuration::TYPE_YAML,
    \Amock\Configuration::SOURCE_TYPE_DIR,
    '/path/to/mock_fixtures'
);

$amock = \Amock\Amock::create($config);
```

Then you can use the configured mocks in your tests:

```php
$stub = $amock->get('mockSomeApi404Response', $this);
```

# Example

There is an dummy project [here](https://github.com/thanosKontos/amock-example) that you can use as a reference.
