<?php
declare(strict_types = 1);
define("ROOT_PATH", realpath('.'));

if (file_exists(ROOT_PATH . '/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH . '/vendor/autoload.php';

use IWD\JobInterview\Repository\SurveyRepository;
use IWD\JobInterview\Controller\SurveyController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

$app = new Application();

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Content-Type', 'application/json');
});

// Repositories
$app['survey.repository'] = function () use ($app) {
    return new SurveyRepository();
};

// Controllers
$app['survey.controller'] = function () use ($app) {
    return new SurveyController($app['survey.repository']);
};

// survey routes
$app->get('/', function () use ($app) {
    return new Response('Go to http://localhost:8080/surveys to get the survey list');
});

$app->get('/surveys', function () use ($app) {
    $surveys = $app['survey.controller']->getAllActionJSON();
    return new Response($surveys);
});

$app->run();

return $app;
