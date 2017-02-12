<?php

namespace MehrAlsNix\JsonFaker;

use Faker\Factory;

class JsonFaker
{
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
        try {
            $json = $this->jsonTemplate;

            if ($this->fromFile) {
                $json = file_get_contents($this->jsonTemplate);
            }

            $json = json_decode($json, true);
            array_walk_recursive($json, [$this, 'getFakeValue']);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        return json_encode($json, JSON_PRETTY_PRINT);
    }

    /**
     * @param string $original
     * @param $key
     * @return float|int|mixed|string
     */
    private function getFakeValue(&$original)
    {
        if (is_array($original) || is_object($original)) {
            return $original;
        } elseif ($original === "__RAND_NUMBER__") {
            $original = $this->faker->randomNumber();
        } elseif ($original === "__RAND_FLOAT__") {
            $original = $this->faker->randomFloat();
        } elseif ($original === "__RAND_BOOLEAN__") {
            $original = $this->faker->randomElement([true, false]);
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
    }
}
