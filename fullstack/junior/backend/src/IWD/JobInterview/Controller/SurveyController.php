<?php

namespace IWD\JobInterview\Controller;

use IWD\JobInterview\Repository\SurveyRepository;

class SurveyController
{

    protected $repo;

    public function __construct(SurveyRepository $repo)
    {
        $this->repo = $repo;
    }

    function getAllActionJSON()
    {
        return $this->repo->serialize($this->repo->getAllDistinct());
    }
}