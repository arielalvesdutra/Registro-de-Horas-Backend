<?php

namespace App\Controllers;

use App\Core\Database;
use Psr\Http\Message\ResponseInterface;
//use Psr\Http\Message\ResponseInterface;

use Psr\Http\Message\ServerRequestInterface;

class Controller {

    public function info()
    {
        phpinfo();
    }

    public function test()
    {
        echo "It works!";
    }

    public function testDatabaseConnection()
    {
        Database::connect();
    }

    public function testJsonResponse(ServerRequestInterface $request,
                                     ResponseInterface $response)
    {
        $data = [
            'teste' => 'funcionando'
        ];

        return $response->withJson($data, 302);
    }

}