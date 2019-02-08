<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Test extends Controller
{
    public function info()
    {
        phpinfo();
    }

    public function test()
    {
        echo "It works!";
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    public function testJsonResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = [
            'teste' => 'funcionando'
        ];

        return $response->withJson($data, 302);
    }
}