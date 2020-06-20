# json-faker

Creates JSON fixtures with [fzaninotto/Faker](https://github.com/fzaninotto/Faker)

[![Build Status](https://travis-ci.org/MehrAlsNix/json-faker.svg?branch=master)](https://travis-ci.org/MehrAlsNix/json-faker)
[![Total Downloads](https://poser.pugx.org/mehr-als-nix/json-faker/downloads)](https://packagist.org/packages/mehr-als-nix/json-faker)

## Installation

Add `mehr-als-nix/json-faker` dependency to the `require` section inside your composer.json
```json
"require": {
    "mehr-als-nix/json-faker": "*"
}
```

## Examples

```php
<?php

use MehrAlsNix\JsonFaker\JsonFaker;

$jsonTemplate = <<<JSON
{
  "options": [
    {
      "__JSON_OPTIONS__": "JSON_PRETTY_PRINT|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_UNESCAPED_SLASHES",
      "__NODE_CLONE__": 3
    }
  ],
  "fixture": [
    {
      "float-value": "__RAND_FLOAT__",
      "boolean-value": "__RAND_BOOLEAN__",
      "number-value": "__RAND_NUMBER__",
      "simple-text": "__RAND_TEXT__",
      "user-agent": "__RAND_USERAGENT__"
    }
  ]
}
JSON;

echo (string) new JsonFaker($jsonTemplate, false);

```

Running this script generates a JSON string with random values like:
```json
[
    {
        "float-value": 157176.955378,
        "boolean-value": true,
        "number-value": 855701,
        "simple-text": "pariatur ad",
        "user-agent": "Opera/8.99 (Windows NT 6.2; sl-SI) Presto/2.9.218 Version/12.00"
    },
    {
        "float-value": 1,
        "boolean-value": true,
        "number-value": 1207,
        "simple-text": "ex sit",
        "user-agent": "Mozilla/5.0 (iPad; CPU OS 7_1_1 like Mac OS X; sl-SI) AppleWebKit/535.11.1 (KHTML, like Gecko) Version/4.0.5 Mobile/8B118 Safari/6535.11.1"
    },
    {
        "float-value": 933,
        "boolean-value": true,
        "number-value": 59201435,
        "simple-text": "voluptatem qui",
        "user-agent": "Mozilla/5.0 (iPad; CPU OS 8_1_2 like Mac OS X; en-US) AppleWebKit/532.46.4 (KHTML, like Gecko) Version/4.0.5 Mobile/8B116 Safari/6532.46.4"
    }
]
```
