# Amock - Organize your mock objects in configuration files (yaml/ini) for phpunit

## Release notes

**Under development. Do not use!**

## Instructions

`composer require-dev thanosKontos/amock`

Add a directory to store your fixtures e.g. `tests/mock_fixtures` and as as many yaml files as you want.

```yaml
# tests/mock_fixtures/repositories.yml

Mockaccino\ToBeDeleted\SomeRepository:
  mockRepositoryInsert:
    disableConstructor: true
    mockMethods:
      insert: null
```

```yaml
# tests/mock_fixtures/other.yml

Mockaccino\ToBeDeleted\HttpClient:
  mockSuccessResponse:
    disableConstructor: true
    getResponse: 'Some successful mock reponse'
  mockErrorResponse:
    disableConstructor: true
    getResponse: 'Some error mock reponse'
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
$stub = $amock->get('mockErrorResponse', $this);
```
