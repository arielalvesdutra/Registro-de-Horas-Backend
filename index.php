<?php

require 'bootstrap.php';

use Slim\App;

$app = new App([
    'settings' => [
        'displayErrorDetails' => true,
        'debug'               => true,
        'determineRouteBeforeAppMiddleware' => true
    ]
]);

$app->get('/', function(){
   echo "Iniciando a aplciação Backend de Registro de horas...";
});

$app->run();