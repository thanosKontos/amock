# Amock - Organize your stub objects in yaml

[![Latest Stable Version](https://poser.pugx.org/thanos-kontos/amock/v/stable)](https://packagist.org/packages/thanos-kontos/amock)
[![Build Status](https://scrutinizer-ci.com/g/thanosKontos/amock/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thanosKontos/amock/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/thanosKontos/amock/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thanosKontos/amock/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thanosKontos/amock/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thanosKontos/amock/?branch=master)

## Release notes

**Still not 100% stable. Use with caution**

## In a glance

Quoting from phpunit:

> Sometimes it is just plain hard to test the system under test (SUT) because it depends on other components that cannot be used in the test environment. This could be because they aren't available, they will not return the results needed for the test or because executing them would have undesirable side effects. In other cases, our test strategy requires us to have more control or visibility of the internal behavior of the SUT.

> When we are writing a test in which we cannot (or chose not to) use a real depended-on component (DOC), we can replace it with a Test Double. The Test Double doesn't have to behave exactly like the real DOC; it merely has to provide the same API as the real one so that the SUT thinks it is the real one!

It is almost impossible to write good tests without stubbing objects, because we often need to imitate writing to a database or calling an external service.

*Amock* lets you create these stub objects in yaml instead of "polluting" your tests with irrelevant code.

## Instructions

`composer require --dev thanos-kontos/amock`

Add a directory to store your fixtures e.g. `tests/mock_fixtures` and as as many yaml files as you want.

```yaml
# tests/mock_fixtures/repositories.yml

MyProject\Library\UserRepository:
  mockUserRepository:
    disableConstructor: true
    mockMethods:
      insert: '@null'
      update: '@null'
MyProject\Library\ProductRepository:
  mockProductRepository:
    disableConstructor: true
    mockMethods:
      insert: '@null'
      update: '@null'
```

```yaml
# tests/mock_fixtures/gateways.yml

MyProject\Library\SomeApiGateway:
  mockSuccessResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@string:{"hello":"world"}'
  mock404Response:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@string:{"error": "404","message":"Not found"}'
      sampleSetter: '@self'
      methodThatReturnsDifferentValueOnConsecutiveCalls:
        - '@string:{"hello":"world"}'
        - '@integer:123'
        - '@boolean:false'
      methodThatReturnsArray: '@array:{"111":"aaa","222":"bbb"}'
      methodThatReturnsBoolean: '@boolean:false'
      methodThatReturnsInteger: '@integer:123'
      methodThatReturnsNull: '@null'
  mockExceptionResponse:
    disableConstructor: true
    mockMethods:
      getHelloReponse: '@exception:\MyProject\Library\Exception\ApiException'
```

On your test setUp method

```php
$config = new \Amock\Configuration('yaml', 'dir', '/path/to/mock_fixtures');
$this->amock = \Amock\Amock::create($config, $testCase);
```

or

```php
$config = new \Amock\Configuration('yaml', 'file', '/path/to/mock_fixtures/somefile.yml');
$this->amock = \Amock\Amock::create($config, $testCase);
```

Then you can use the configured mocks in your tests:

```php
$stub = $this->amock->get('mock404Response');
```

# Example

There is an dummy project [here](https://github.com/thanosKontos/amock-example) that you can use as a reference.

## License

Amock is released under the [MIT License](https://opensource.org/licenses/MIT).
