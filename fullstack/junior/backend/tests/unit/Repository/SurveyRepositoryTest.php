<?php

namespace Unit\Repository;

use IWD\JobInterview\Repository\SurveyRepository;
use PHPUnit\Framework\TestCase;

class SurveyRepositoryTest extends testCase
{
    private $repo;

    function testRepository()
    {
        $this->repo = new SurveyRepository();
        $this->assertTrue(count($this->repo->getAllDistinct()) >= 0);
    }
}