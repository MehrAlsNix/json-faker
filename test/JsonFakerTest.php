<?php

namespace MehrAlsNix\Test\JsonFaker;

use MehrAlsNix\JsonFaker\JsonFaker;
use PHPUnit\Framework\TestCase;

class JsonFakerTest extends TestCase
{
    /** @var JsonFaker $jsonFaker */
    private $jsonFaker;
    private $json;

    public function setUp(): void
    {
        $this->json = __DIR__ . '/../examples/templates/example.json';
        $this->jsonFaker = new JsonFaker($this->json);
    }

    public function tearDown(): void
    {
        $this->json = null;
        $this->jsonFaker = null;
    }

    /**
     * @test
     */
    public function createInstance()
    {
        $this->assertInstanceOf(JsonFaker::class, $this->jsonFaker);
    }

    /**
     * @test
     */
    public function generateRandomValues()
    {
        $this->assertJsonStringNotEqualsJsonString(file_get_contents($this->json), (string) $this->jsonFaker);
    }
}
