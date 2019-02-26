<?php

namespace App\Controllers;

use App\Database\Factories\Connections\DefaultDatabaseConnection;
use App\Models;
use App\Repositories;
use App\Services;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @property Repositories\TimeRecorder $repository
 */
class TimeRecorder extends Controller
{

    public function __construct()
    {
        $this->setRepository(new Repositories\TimeRecorder(
            new Models\TimeRecord(DefaultDatabaseConnection::connect()),
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
            return $response->withStatus(400);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function deleteRecord(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

            $recordId = $request->getAttribute('id');

            $this->repository->deleteTimeRecord($recordId);

            return $response->withStatus(200);
        } catch (\Exception $exception) {
            return $response->withStatus(400);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return JSON
     */
    public function getRecords(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

            $queryParameters = $request->getQueryParams();

            $records = $this->repository->getTimeRecords($queryParameters);

            return $response->withJson($records);
        } catch (\Exception $exception) {
            return $response->withStatus(400);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateRecord(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

            $parameters = $request->getParsedBody();

            $this->repository->updateTimeRecord($parameters);

            return $response->withStatus(200);
        } catch (\Exception $exception) {
            return $response->withStatus(400);
        }
    }
}