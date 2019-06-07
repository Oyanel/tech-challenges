<?php

namespace Functional\Client\WebApp;

use IWD\JobInterview\Repository\SurveyRepository;
use Silex\WebTestCase;

class AppTest extends WebTestCase
{
    const JSON_FILE = __DIR__ . "/../testFiles/SurveysList.json";
    private $bodySurveyList;
    private $httpClient;

    public function createApplication()
    {
        return require __DIR__ . '/../../../../src/Client/Webapp/app.php';
    }

    function testSurveys()
    {
        $this->httpClient = $this->createClient();
        $this->bodySurveyList = file_get_contents(self::JSON_FILE);
        $this->surveyList();
    }

    private function surveyList()
    {
        $endPoint = "/surveys";
        $this->httpClient->request('GET', $endPoint);

        // Check return status code
        $this->assertTrue($this->httpClient->getResponse()->isSuccessful());

        $pageContent = json_decode($this->httpClient->getResponse()->getContent());
        // Check if content is a list
        $this->assertTrue(is_array($pageContent));
    }
}