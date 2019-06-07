<?php

namespace Unit\Repository;

use IWD\JobInterview\Repository\BaseJsonRepository;
use PHPUnit\Framework\TestCase;
use stdClass;

class BaseJsonRepositoryTest extends testCase
{
    private $repo;

    function testRepository()
    {
        $this->repo = new BaseJsonRepository();
        $mock = new stdClass;
        $mock->test = "test";

        // Test isJson
        $this->assertTrue($this->repo->isJson('{"test": "test"}'));
        $this->assertFalse($this->repo->isJson("<html></html>"));
        $this->assertFalse($this->repo->isJson($mock));

        // Test serialize
        $serialized = $this->repo->serialize($mock);
        $this->assertTrue(is_string($serialized));

        // Test deserialize
        $stdClass = $this->repo->deserialize($serialized, stdClass::class);
        $this->assertEquals('object', gettype($stdClass));
    }
}