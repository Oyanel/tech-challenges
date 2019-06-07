<?php

namespace IWD\JobInterview\Repository;

use IWD\JobInterview\Model\Survey;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class SurveyRepository extends BaseJsonRepository
{
    const SURVEY_DIRECTORY = __DIR__ . "/../../../../data/surveys";

    function getAllDistinct()
    {
        $surveyList = [];

        $files = $this->getAllJSON(self::SURVEY_DIRECTORY);

        /** @var SplFileInfo $file */
        foreach ($files->getIterator() as $file) {
            try {
                // @TODO Wrapper the survey in a parent object to avoid this :
                $surveyJson = json_encode(json_decode($file->getContents())->survey);
                $survey = $this->deserialize($surveyJson, Survey::class);
                $surveyList[$survey->getCode()] = $survey;
            } catch (NotEncodableValueException $error) {
                //logger @TODO use real logger
                return 'error';
            }
        }
        return array_values($surveyList);
    }
}