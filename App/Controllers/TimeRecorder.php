<?php

namespace App\Controllers;

use App\Models;
use App\Repositories;
use App\Services;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TimeRecorder extends Controller {

    public function __construct()
    {
        $this->setRepository(new Repositories\TimeRecorder(
            new Models\TimeRecord(),
            new Services\TimeRecorderService()
        ));
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function addRecord(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

            $parameters = $request->getParsedBody();

            $this->repository->addTimeRecord($parameters);

            return $response->withStatus(200);
        } catch (\Exception $exception) {
            return $response->withStatus(500);
        }
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function deleteRecord(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');

        $this->repository->deleteTimeRecord($id);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return JSON
     */
    public function getRecords(ServerRequestInterface $request, ResponseInterface $response)
    {
        $queryParameters = $request->getQueryParams();

        $records = $this->repository->getTimeRecords($queryParameters);

        return $response->withJson($records);
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function updateRecord(ServerRequestInterface $request)
    {
        $parameters = $request->getParsedBody();

        $this->repository->updateTimeRecord($parameters);
    }
}