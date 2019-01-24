<?php

namespace App\Controllers;

use App\Repositories;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TimeRecorder extends Controller {

    public function addRecord(ServerRequestInterface $request)
    {
        $parameters = $request->getParsedBody();

        Repositories\TimeRecorder::addTimeRecord($parameters);
    }

    public function deleteRecord()
    {
        echo "deleteRecord()";
    }

    public function getRecords()
    {
        Repositories\TimeRecorder::getTimeRecords();
    }

    public function updateRecord(ServerRequestInterface $request)
    {
        echo "updateRecord()";
    }
}