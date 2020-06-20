<?php

namespace MehrAlsNix\JsonFaker;

use Faker\Factory;

class JsonFaker
{
    private static $OPTIONS = [
        '__JSON_OPTIONS__' => false,
        '__NODE_CLONE__' => false
    ];

    /** @var string $jsonTemplate */
    private $jsonTemplate;

    /** @var Factory $faker */
    private $faker;
    private $fromFile;

    /**
     * JsonFaker constructor.
     * @param string $jsonTemplate
     */
    public function __construct($jsonTemplate, $fromFile = true)
    {
        $this->jsonTemplate = $jsonTemplate;
        $this->faker = Factory::create();
        $this->fromFile = $fromFile;
    }

    public function __toString()
    {
        $json = $this->jsonTemplate;

        if ($this->fromFile) {
            $json = file_get_contents($this->jsonTemplate);
        }

        $json = json_decode($json, true);
        $fixture = $json['fixture'];

        self::$OPTIONS = array_merge(self::$OPTIONS, $json['options'][0]);

        if (self::$OPTIONS['__NODE_CLONE__']) {
            $fixture = array_fill(0, (int) self::$OPTIONS['__NODE_CLONE__'], $fixture[0]);
        }

        array_walk_recursive($fixture, [$this, 'getFakeValue']);

        if (self::$OPTIONS['__JSON_OPTIONS__']) {
            $options = explode('|', self::$OPTIONS['__JSON_OPTIONS__']);
            $opt = 0;
            foreach ($options as $option) {
                $opt |= constant($option);
            }
            return (string) json_encode($fixture, $opt);
        }

        return (string) json_encode($fixture);
    }

    /**
     * @param mixed $original
     * @return mixed
     */
    private function getFakeValue(&$original)
    {
        if (is_array($original) || is_object($original)) {
            return $original;
        }

        if ($original === "__RAND_NUMBER__") {
            $original = $this->faker->randomNumber();
        } elseif ($original === "__RAND_FLOAT__") {
            $original = $this->faker->randomFloat();
        } elseif ($original === "__RAND_BOOLEAN__") {
            $original = $this->faker->randomElement([true, false]);
        } elseif ($original === '__RAND_USERAGENT__') {
            $original = $this->faker->userAgent;
        } elseif (is_numeric($original)) {
            if (strpos($original, '.') !== false) {
                $original = $this->faker->randomFloat();
            } else {
                $original = $this->faker->randomNumber(strlen($original));
            }
        } elseif (is_bool($original)) {
            $original = $this->faker->randomElement([true, false]);
        } else {
            $wordCount = str_word_count($original);
            $newLineCount = substr_count($original, "\n");
            if ($newLineCount > 0 && $wordCount > 5) {
                $original = implode("\n", $this->faker->paragraphs($newLineCount));
            } else {
                $original = implode(' ', $this->faker->words($wordCount));
            }
        }
        
        return $original;
    }
}
