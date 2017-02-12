# json-faker
Creates JSON fixtures with [fzaninotto/Faker](https://github.com/fzaninotto/Faker)

## Installation

Add `mehr-als-nix/json-faker` dependency to the `require` section inside your composer.json
```json
"require": {
    "mehr-als-nix/json-faker": "*"
}
```

## Examples

```php

use MehrAlsNix\JsonFaker\JsonFaker;

$jsonTemplate = <<<JSON
[
  {
    "float-value": "__RAND_FLOAT__",
    "boolean-value": "__RAND_BOOLEAN__",
    "number-value": "__RAND_NUMBER__",
    "simple-text": "__RAND__TEXT__"
  }
]
JSON;

echo (string) new JsonFaker($jsonTemplate, false);

```

Running this script generates a JSON string with random values like:
```json
[
    {
        "float-value": 5.234791,
        "boolean-value": true,
        "number-value": 867,
        "simple-text": "id consequatur"
    }
]
```
