<?php

require 'bootstrap.php';

use App\Controllers\Controller;
use App\Controllers\TimeRecorder;
use Slim\App;

$app = new App([
    'settings' => [
        'displayErrorDetails' => true,
        'debug'               => true,
        'determineRouteBeforeAppMiddleware' => true
    ]
]);

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD');
});

/**
 * Raiz
 */
$app->get('/', function(){
   echo "Iniciando a aplicação Backend de Registro de horas...";
});

/**
 * Controller
 */
$app->get('/info', Controller::class. ':info');
$app->get('/json', Controller::class. ':testJsonResponse');
$app->get('/test', Controller::class. ':test');
$app->get('/testDatabaseConnection', Controller::class. ':testDatabaseConnection');


/**
 * Time Recorder
 */
$app->delete('/deleteRecord/{id}', TimeRecorder::class . ':deleteRecord');
$app->get('/getRecords', TimeRecorder::class . ':getRecords');
$app->post('/addRecord', TimeRecorder::class . ':addRecord');
$app->put('/updateRecord/{id}', TimeRecorder::class . ':updateRecord');

$app->run();