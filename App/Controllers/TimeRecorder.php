<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TimeRecorder extends Controller {

    public function addRecord()
    {
        echo "addRecord()";
    }

    public function deleteRecord()
    {
        echo "deleteRecord()";
    }

    public function getRecords()
    {
        echo "getRecords()";
    }

    public function updateRecord(ServerRequestInterface $request)
    {
        echo "updateRecord()";
    }
}