# json-faker

Creates JSON fixtures with [fzaninotto/Faker](https://github.com/fzaninotto/Faker)

[![Build Status](https://travis-ci.org/MehrAlsNix/json-faker.svg?branch=develop)](https://travis-ci.org/MehrAlsNix/json-faker)

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
{
  "options": [
    {
      "__JSON_OPTIONS__": "JSON_PRETTY_PRINT|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP"
    }
  ],
  "fixture": [
    {
      "float-value": "__RAND_FLOAT__",
      "boolean-value": "__RAND_BOOLEAN__",
      "number-value": "__RAND_NUMBER__",
      "simple-text": "__RAND__TEXT__"
    },
    [
      {
        "float-value": "__RAND_FLOAT__",
        "boolean-value": "__RAND_BOOLEAN__",
        "number-value": "__RAND_NUMBER__",
        "simple-text": "test test test",
        "simple-array": [
          "1",
          2,
          "__RAND_FLOAT__"
        ]
      },
      {
        "float-value": "__RAND_FLOAT__",
        "boolean-value": "__RAND_BOOLEAN__",
        "number-value": "__RAND_NUMBER__"
      }
    ]
  ]
}
JSON;

echo (string) new JsonFaker($jsonTemplate, false);

```

Running this script generates a JSON string with random values like:
```json
[
    {
        "float-value": 619505.89336841,
        "boolean-value": false,
        "number-value": 46243865,
        "simple-text": "aspernatur saepe"
    },
    [
        {
            "float-value": 866878.15492,
            "boolean-value": false,
            "number-value": 0,
            "simple-text": "dolores voluptates assumenda",
            "simple-array": [
                5,
                6,
                1072888.1899307
            ]
        },
        {
            "float-value": 3733219.1933299,
            "boolean-value": true,
            "number-value": 705
        }
    ]
]
```
