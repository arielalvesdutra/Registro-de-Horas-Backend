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